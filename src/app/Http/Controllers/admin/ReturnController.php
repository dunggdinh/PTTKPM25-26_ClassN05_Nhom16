<?php

namespace App\Http\Controllers\admin; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ReturnRequest;
use App\Models\auth\User;
use App\Models\admin\Order;
use App\Models\admin\OrderItem;
use App\Models\admin\Product;

class ReturnController extends Controller
{
    public function index(Request $request)
    {
        // Query setup for ReturnRequests
                // Query setup for ReturnRequests
        $query = ReturnRequest::query();

        // Filtering by status
        if ($request->filled('status')) {
            $status = $request->status;
            switch($status) {
                case 'pending':
                    $query->where('status', 'Chờ xử lý');
                    break;
                case 'approved':
                    $query->where('status', 'Đã duyệt');
                    break;
                case 'completed':
                    $query->where('status', 'Hoàn tất');
                    break;
                case 'rejected':
                    $query->where('status', 'Từ chối');
                    break;
            }
        }

        // Filtering by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filtering by date
        if ($request->filled('date')) {
            $query->whereDate('requested_at', $request->date);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = "%{$request->search}%";
            $query->where(function($q) use ($search) {
                $q->where('reason', 'like', $search)
                  ->orWhere('return_id', 'like', $search)
                  ->orWhere('order_item_id', 'like', $search)
                  ->orWhereHas('orderItem.order.user', function($q) use ($search) {
                      $q->where('name', 'like', $search)
                        ->orWhere('email', 'like', $search);
                  })
                  ->orWhereHas('orderItem.product', function($q) use ($search) {
                      $q->where('name', 'like', $search);
                  });
            });
        }

        // Pagination and ordering
        $sortBy = $request->get('sort_by', 'return_id');
        $sortDirection = $request->get('sort_direction', 'asc');
        
        // Make sure we load all needed relationships
        $returns = $query->with([
            'orderItem.product',
            'orderItem.order.user'
        ])
        ->orderBy($sortBy, $sortDirection)
        ->paginate(10)
        ->withQueryString();

        // Statistics for return requests
        $stats = [
            'pending' => ReturnRequest::where('status', ReturnRequest::STATUS_PENDING)->count(),
            'approved' => ReturnRequest::where('status', ReturnRequest::STATUS_APPROVED)->count(),
            'completed' => ReturnRequest::where('status', ReturnRequest::STATUS_COMPLETED)->count(),
            'rejected' => ReturnRequest::where('status', ReturnRequest::STATUS_REJECTED)->count(),
        ];

        // Get users with customer role
        $users = User::where('role', 'customer')->get();
        
        // Get all products
        $products = Product::all();

        return view('admin.return', compact('returns', 'stats', 'users', 'products'));
    }

    public function store(Request $request)
    {
        try {
            // Validating the incoming request
            $validatedData = $request->validate([
                'customer_id' => 'required|exists:users,user_id',
                'product_id' => 'required|exists:products,product_id',
                'type' => 'required|in:Trả hàng,Đổi hàng',
                'reason' => 'required|string',
            ]);

            // Creating a temporary order item
            $orderItem = OrderItem::create([
                'order_id' => 'TEMP_' . time(),
                'product_id' => $validatedData['product_id'],
                'quantity' => 1,
                'unit_price' => 0,
            ]);

            // Creating the return request
            $returnRequest = ReturnRequest::create([
                'order_item_id' => $orderItem->order_item_id,
                'customer_id' => $validatedData['customer_id'],
                'type' => $validatedData['type'],
                'reason' => $validatedData['reason'],
                'status' => ReturnRequest::STATUS_PENDING,
                'requested_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Yêu cầu hoàn trả đã được tạo thành công.',
                'data' => $returnRequest
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ], 500);
        }
    }

public function edit($return_id)
{
    try {
        $return = ReturnRequest::with(['orderItem.order.user', 'orderItem.product'])
            ->findOrFail($return_id);

        return response()->json([
            'id' => $return->return_id,
            'status' => $return->status,
            'type' => $return->type,
            'reason' => $return->reason,
            'customer' => optional($return->orderItem->order->user)->name ?? 'N/A',
            'product' => optional($return->orderItem->product)->name ?? 'N/A',
            'requested_at' => $return->requested_at
        ]);
    } catch (\Exception $e) {
        \Log::error('Return Edit Error', [
            'id' => $return_id,
            'message' => $e->getMessage(),
        ]);
        return response()->json(['error' => 'Không thể tải thông tin yêu cầu'], 500);
    }
}






    public function update(Request $request, $return_id)
    {
        try {
            // Validating the update request
            $validatedData = $request->validate([
                'status' => 'required|string|in:Chờ xử lý,Đã duyệt,Hoàn tất,Từ chối',
                'type' => 'required|string|in:Trả hàng,Đổi hàng',
                'reason' => 'required|string',
            ]);

            // Finding the ReturnRequest by return_id
            $returnRequest = ReturnRequest::findOrFail($return_id);

            // Cập nhật thông tin
            $returnRequest->type = $validatedData['type'];
            $returnRequest->status = $validatedData['status'];
            $returnRequest->reason = $validatedData['reason'];
            
            
            if ($returnRequest->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Yêu cầu hoàn trả đã được cập nhật thành công.',
                    'data' => $returnRequest
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Không thể cập nhật yêu cầu. Vui lòng thử lại.'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi cập nhật: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($return_id)
    {
        // Finding the ReturnRequest by return_id
        $returnRequest = ReturnRequest::findOrFail($return_id);

        // Deleting the return request
        $returnRequest->delete();

        return redirect()->route('admin.return')->with('success', 'Yêu cầu hoàn trả đã được xóa thành công.');
    }
}
