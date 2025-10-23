<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

// Models (đúng theo namespace cậu đang dùng)
use App\Models\admin\ProductReview;
use App\Models\admin\Product;
use App\Models\admin\Order;
use App\Models\admin\OrderItem;

class ReviewController extends Controller
{
    /**
     * Trang review (render Blade của cậu).
     * Mặc định tớ không đổ data nặng; phần danh sách & eligible sẽ kéo qua API JSON
     * để cậu làm lazy load/JS nếu muốn. Nhưng vẫn support preselect qua query.
     */
    public function index(Request $request)
    {
        // Có thể pass thêm filter mặc định nếu cần
        return view('customer.reviews'); // <- thay bằng view blade của cậu
    }

    /**
     * API: Danh sách review (lọc/sắp xếp/phân trang)
     * GET /reviews/_list.json?product_id=&stars=&sort=&page=
     * sort: newest|oldest|highest|lowest
     */
    public function list(Request $request)
    {
        try {
            $query = ProductReview::with(['user', 'product']);

            $query->where('status', '!=', 'hidden');

            if ($request->filled('product_id')) {
                $query->where('product_id', $request->product_id);
            }
            // ----- LỌC THEO SỐ SAO -----
            if ($request->filled('stars')) {
                $stars = intval($request->input('stars'));
                if ($stars >= 1 && $stars <= 5) {
                    $query->where('rating', $stars);
                }
            }

            // ----- SẮP XẾP THEO TIÊU CHÍ -----
            $sort = $request->input('sort', 'newest');
            switch ($sort) {
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'highest':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'lowest':
                    $query->orderBy('rating', 'asc');
                    break;
                case 'newest':
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }


            $reviews = $query->paginate((int)$request->get('per_page', 10));

            return response()->json([
                'data' => $reviews->items(),
                'meta' => [
                    'current_page' => $reviews->currentPage(),
                    'last_page'    => $reviews->lastPage(),
                    'per_page'     => $reviews->perPage(),
                    'total'        => $reviews->total(),
                ],
            ]);
        } catch (\Throwable $e) {
            \Log::error('customer.reviews.list_failed', ['msg' => $e->getMessage()]);
            return response()->json(['message' => 'Server error', 'error' => $e->getMessage()], 500);
        }
    }

    public function eligible()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $items = OrderItem::query()
            ->select([
                'order_items.order_item_id',
                'order_items.product_id',
                'order_items.order_id',
                'orders.created_at as ordered_at',
                'orders.status as order_status',
                'products.name as product_name',
                // 'products.image_url as product_image',
                // 'products.description as product_desc',
            ])
            ->join('orders', 'orders.order_id', '=', 'order_items.order_id')
            ->join('products', 'products.product_id', '=', 'order_items.product_id')
            ->where('orders.user_id', $user->user_id)
            ->whereIn('orders.status', ['Đã nhận hàng', 'Đã giao', 'Hoàn thành', 'delivered', 'completed'])
            ->orderByDesc('orders.created_at')
            ->get();

        return response()->json(['data' => $items]);
    }
    /**
     * API: Liệt kê sản phẩm user đã mua & đã giao, chưa review (eligible để viết review).
     * GET /reviews/_eligible.json
     */
    public function eligibleProducts(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Các trạng thái đơn được coi là đã nhận hàng/đã giao
        $deliveredStatuses = ['Đã giao', 'Hoàn thành', 'delivered', 'completed'];

        $items = OrderItem::query()
            ->select([
                'order_items.order_id',
                'order_items.product_id',
                'products.name as product_name',
                'products.image_url as product_image',
                'orders.created_at as ordered_at',
                'orders.status as order_status',
            ])
            ->join('orders', 'orders.order_id', '=', 'order_items.order_id')
            ->join('products', 'products.product_id', '=', 'order_items.product_id')
            ->leftJoin('product_reviews as pr', function ($join) use ($user) {
                $join->on('pr.product_id', '=', 'order_items.product_id')
                     ->on('pr.order_id', '=', 'order_items.order_id')
                     ->where('pr.user_id', '=', $user->user_id);
            })
            ->where('orders.user_id', $user->user_id)
            ->whereIn('orders.status', $deliveredStatuses)
            ->whereNull('pr.review_id') // chưa có review cho cặp (product_id, order_id, user_id)
            ->orderByDesc('orders.created_at')
            ->get();

        return response()->json(['data' => $items]);
    }

    /**
     * Tạo review.
     * POST /reviews
     * body: product_id, order_id (khuyến khích), rating (1..5), title (optional), comment, image (optional)
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Vui lòng đăng nhập'], 401);
        }

        // Validate input
        $validated = $request->validate([
            'product_id' => ['required', Rule::exists('products', 'product_id')],
            'order_id'   => ['nullable', Rule::exists('orders', 'order_id')],
            'rating'     => ['required','integer','min:1','max:5'],
            'title'      => ['nullable','string','max:150'],
            'comment'    => ['required','string','min:10','max:2000'],
        ], [
            'product_id.required' => 'Thiếu sản phẩm.',
            'rating.required'     => 'Vui lòng chọn số sao.',
            'comment.required'    => 'Vui lòng nhập nội dung đánh giá.',
        ]);

        // Kiểm tra user đã mua & đơn đã giao (nếu order_id cung cấp)
        $deliveredStatuses = ['Đã giao', 'Hoàn thành', 'delivered', 'completed'];

        if (!empty($validated['order_id'])) {
            $owned = OrderItem::query()
                ->join('orders', 'orders.order_id', '=', 'order_items.order_id')
                ->where('orders.user_id', $user->user_id)
                ->where('order_items.product_id', $validated['product_id'])
                ->where('order_items.order_id', $validated['order_id'])
                ->whereIn('orders.status', $deliveredStatuses)
                ->exists();

            if (!$owned) {
                return response()->json([
                    'message' => 'Đơn hàng/sản phẩm không hợp lệ để đánh giá.'
                ], 422);
            }
        } else {
            // Không truyền order_id: check user có bất kỳ đơn đã giao chứa sản phẩm này
            $owned = OrderItem::query()
                ->join('orders', 'orders.order_id', '=', 'order_items.order_id')
                ->where('orders.user_id', $user->user_id)
                ->where('order_items.product_id', $validated['product_id'])
                ->whereIn('orders.status', $deliveredStatuses)
                ->exists();

            if (!$owned) {
                return response()->json([
                    'message' => 'Bạn chưa mua/nhận sản phẩm này nên chưa thể đánh giá.'
                ], 422);
            }
        }

        // Đảm bảo 1 review / (user, product, order)
        $dupCheck = ProductReview::query()
            ->where('user_id', $user->user_id)
            ->where('product_id', $validated['product_id']);

        if (!empty($validated['order_id'])) {
            $dupCheck->where('order_id', $validated['order_id']);
        }

        if ($dupCheck->exists()) {
            return response()->json([
                'message' => 'Bạn đã đánh giá sản phẩm này cho đơn hàng này rồi.'
            ], 409);
        }

        // Tạo review (Model đã có boot() sinh review_id: REV_XXX)
        try {
            $review = ProductReview::create([
                'review_id'  => null,
                'product_id' => $validated['product_id'],
                'user_id'    => $user->user_id,
                'order_id'   => $validated['order_id'] ?? null,
                'rating'     => (int)$validated['rating'],
                'comment'    => trim(($request->input('title') ? ($request->input('title')."\n\n") : '') . $validated['comment']),
                'image_url'  => null,
                'status'     => 'pending',
            ]);
        } catch (\Throwable $e) {
            \Log::error('customer.reviews.store_failed', ['err' => $e->getMessage()]);
            return response()->json(['message'=>'Server error','error'=>$e->getMessage()], 500);
        }

        return response()->json([
            'message' => 'Đã gửi đánh giá, chờ duyệt. Cảm ơn bạn! 🎉',
            'data'    => $review,
        ], 201);
    }
}
