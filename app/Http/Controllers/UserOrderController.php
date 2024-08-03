<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class UserOrderController extends Controller
{
    public function index()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Lấy tất cả các đơn hàng của người dùng hiện tại
        $orders = Order::where('user_id', $user->id)
        ->with(['orderItems.productVariant.productSize', 'orderItems.productVariant.productColor'])
        ->get();

        return view('order', compact('orders'));
    }
}
