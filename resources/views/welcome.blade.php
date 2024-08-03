@extends('layouts.app')
@section('content')
@if (Route::has('login'))
<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
    @auth

        <a href="{{ route('cart.list') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Cart</a>
        <a href="{{ route('orders.index') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Order</a>
        <a href="{{ route('logout') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log out</a>
    @else
        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
        @endif
    @endauth
</div>
@endif

<div class="mt-16">
    <div class="row">
        @foreach($products as $item)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card border-0 rounded-0 text-center shadow-none overflow-hidden">
                    <a href="{{ route('product.detail', $item->slug) }}">
                        <span class="badge badge-primary"></span>
                        @if(str_contains($item->img_thumb, 'products/'))
                            <img src="{{ Storage::url($item->img_thumb) }}" alt="" class="card-img-top rounded-0">
                        @else
                            <img src="{{ $item->img_thumb }}" alt="" class="card-img-top rounded-0">
                        @endif
                        <div class="card-body">
                            <h4 class="text-uppercase mb-3">{{ $item->name }}</h4>
                            <p class="h4 text-muted font-weight-light mb-3">{{ $item->category->name }}</p>
                            <p class="h4">{{ $item->price_sale ?: $item->price }}</p>
                        </div>
                        <a href="{{ route('product.detail', $item->slug) }}" class="btn btn-primary">Xem chi tiết</a>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
