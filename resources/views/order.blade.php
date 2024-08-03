@extends('layouts.app')

@section('title')
    Đơn hàng của tôi
@endsection

@section('content')
    <h3>Đơn hàng của tôi</h3>

    @if ($orders->count() > 0)
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Sản phẩm</th>
                    <th>Biến thể</th>
                    <th>Email người dùng</th>
                    <th>Tên người dùng</th>
                    <th>Địa chỉ người dùng</th>
                    <th>Số điện thoại người dùng</th>
                    <th>Email người nhận</th>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ người nhận</th>
                    <th>Số điện thoại người nhận</th>
                    <th>Trạng thái đơn hàng</th>
                    <th>Trạng thái thanh toán</th>
                    <th>Tổng giá</th>
                    <th>Ngày tạo</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            @foreach ($order->orderItems as $item)
                                <div>
                                    <p>Tên sản phẩm: {{ $item->product_name }}</p>
                                    <p>Giá: {{ number_format($item->product_price, 2, ',', '.') }} VND</p>
                                    <p>Số lượng: {{ $item->quantity }}</p>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($order->orderItems as $item)
                                <div>
                                    @if ($item->productVariant)
                                        <p>Biến thể: {{ $item->productVariant->productSize->name }} - {{ $item->productVariant->productColor->name }}</p>
                                    @else
                                        <p>Biến thể: Không có</p>
                                    @endif
                                </div>
                            @endforeach
                        </td>
                        <td>{{ $order->user_email }}</td>
                        <td>{{ $order->user_name }}</td>
                        <td>{{ $order->user_address }}</td>
                        <td>{{ $order->user_phone }}</td>
                        <td>{{ $order->receiver_email }}</td>
                        <td>{{ $order->receiver_name }}</td>
                        <td>{{ $order->receiver_address }}</td>
                        <td>{{ $order->receiver_phone }}</td>
                        <td>
                            @if ($order->order_status == 'pending')
                                <span style="color: red;">Chờ xác nhận</span>
                            @elseif ($order->order_status == 'preparing')
                                <span style="color: orange;">Đang chuẩn bị</span>
                            @elseif ($order->order_status == 'shipping')
                                <span style="color: blue;">Đang giao hàng</span>
                            @elseif ($order->order_status == 'completed')
                                <span style="color: green;">Hoàn thành</span>
                            @else
                                <span style="color: gray;">Không xác định</span>
                            @endif
                        </td>
                        <td>
                            @if ($order->payment_status == 'paid')
                                <span style="color: green;">Đã thanh toán</span>
                            @else
                                <span style="color: red;">Chưa thanh toán</span>
                            @endif
                        </td>
                        <td>{{ number_format($order->total_price, 2, ',', '.') }} VND</td>
                        <td>{{ $order->created_at->format('d-m-Y H:i:s') }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Không có đơn hàng nào.</p>
    @endif
@endsection
