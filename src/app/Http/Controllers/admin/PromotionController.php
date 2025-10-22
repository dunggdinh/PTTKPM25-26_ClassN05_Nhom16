<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    public function index() {
        return view('admin.promotion.index');
    }
}
