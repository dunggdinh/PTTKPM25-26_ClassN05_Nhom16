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
        $query = ReturnRequest::query()
            ->with([
                'orderItem.order.user',
                'orderItem.product'
            ]);

        // Filtering by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
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

        $returns = $query->orderBy($sortBy, $sortDirection)
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
        // Validating the incoming request
        $validatedData = $request->validate([
            'order_item_id' => 'required|string',
            'type' => 'required|string',
            'reason' => 'required|string',
        ]);

        // Creating the new return request
        $returnRequest = new ReturnRequest();
        $returnRequest->order_item_id = $validatedData['order_item_id'];
        $returnRequest->type = $validatedData['type'];
        $returnRequest->reason = $validatedData['reason'];
        $returnRequest->status = ReturnRequest::STATUS_PENDING;
        $returnRequest->requested_at = now();
        $returnRequest->save();

        return redirect()->route('admin.return')->with('success', 'Yêu cầu hoàn trả đã được tạo thành công.');
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
                'customer' => $return->orderItem->order->user->name,
                'product' => $return->orderItem->product->name,
                'requested_at' => $return->requested_at
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không thể tải thông tin yêu cầu'], 500);
        }
    }

    public function update(Request $request, $return_id)
    {
        try {
            // Validating the update request
            $validatedData = $request->validate([
                'status' => 'required|string|in:'.implode(',', [
                    ReturnRequest::STATUS_COMPLETED,
                    ReturnRequest::STATUS_APPROVED,
                    ReturnRequest::STATUS_PENDING,
                    ReturnRequest::STATUS_REJECTED
                ]),
                'type' => 'required|string|in:return,exchange',
                'reason' => 'required|string',
            ]);

            // Finding the ReturnRequest by return_id
            $returnRequest = ReturnRequest::findOrFail($return_id);

            // Cập nhật thông tin
            $returnRequest->type = $validatedData['type'];
            $returnRequest->status = $validatedData['status'];
            $returnRequest->reason = $validatedData['reason'];
            
            // Cập nhật processed_at khi thay đổi trạng thái
            if (in_array($validatedData['status'], [
                ReturnRequest::STATUS_COMPLETED,
                ReturnRequest::STATUS_APPROVED,
                ReturnRequest::STATUS_REJECTED
            ])) {
                $returnRequest->processed_at = now();
            }
            
            if ($returnRequest->save()) {
                return redirect()->route('admin.return')
                    ->with('success', 'Yêu cầu hoàn trả đã được cập nhật thành công.');
            }

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Không thể cập nhật yêu cầu. Vui lòng thử lại.']);

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Lỗi khi cập nhật: ' . $e->getMessage()]);
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
