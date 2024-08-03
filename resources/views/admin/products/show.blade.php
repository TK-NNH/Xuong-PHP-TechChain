@extends('admin.layouts.master')

@section('title')
    Chi tiết san pham
@endsection

@section('content')
    <ul>
        <li>Id: {{$product->id}}</li>
        <li>Tên: {{$product->name}}</li>
        <li>Gia: {{$product->price}}</li>
        <li>Gia sale: {{$product->price_sale}}</li>
        <li>danh muc: {{$product->category->name}}</li>
        <li>Ảnh:
            <div style="width: 100px; height: 100px;">
                <img src="{{Storage::url($product->img_thumb)}}" alt="" style="max-width: 100%; max-height: 100%">

            </div>
        </li>
        <li>Trạng thái: {{$product->is_active}}</li>
    </ul>
    {{-- <ul>
        @foreach($product->toArray() as $key => $value)
            <li>{{$key}} : {{$value}}</li>
        @endforeach
    </ul> --}}
@endsection
