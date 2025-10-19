<?php

namespace App\Http\Controllers\admin;
use App\Models\admin\Warranty;  
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class WarrantyController extends Controller
{
    public function index()
    {
        $warranties = Warranty::orderBy('start_date', 'desc')->get();
        // $warranties = Warranty::orderBy('created_at', 'desc')->get();
        $total = $warranties->count();
        $processing = $warranties->where('status', 'processing')->count();
        $completed = $warranties->where('status', 'completed')->count();

        return view('admin.warranties', compact('warranties', 'total', 'processing', 'completed'));
    }
}
