@extends('admin.layouts.master')

@section('title')
    Chỉnh sửa sản phẩm
@endsection

@section('style-libs')
    <!-- Thêm các thư viện CSS cần thiết nếu có -->
@endsection

@section('script-libs')
    <!-- Thêm các thư viện JS cần thiết nếu có -->
@endsection

@section('content')
    <form action="{{route('admin.products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- Nội dung chính -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <!-- Thông tin sản phẩm -->
                        <div class="mb-3">
                            <label for="product-title-input" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="product-title-input" name="name"
                                   value="{{ old('name', $product->name) }}">
                        </div>
                        <div class="mb-3">
                            <label for="product-price-input" class="form-label">Giá</label>
                            <input type="text" class="form-control" id="product-price-input" name="price"
                                   value="{{ old('price', $product->price) }}">
                        </div>
                        <div class="mb-3">
                            <label for="product-price-sale-input" class="form-label">Giá sale</label>
                            <input type="text" class="form-control" id="product-price-sale-input" name="price_sale"
                                   value="{{ old('price_sale', $product->price_sale) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả sản phẩm</label>
                            <div id="ckeditor-classic">
                                <textarea name="description">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>
                        <!-- Ảnh sản phẩm -->
                        <div class="mb-4">
                            <label for="product-img-input" class="form-label">Ảnh sản phẩm</label>
                            <input type="file" name="img_thumb" class="form-control">
                            @if($product->img_thumb)
                                <img src="{{ Storage::url($product->img_thumb) }}" alt="Ảnh sản phẩm" width="100">
                            @endif
                        </div>
                        <div>
                            <label for="product-gallery-input" class="form-label">Thư viện ảnh</label>
                            <input type="file" name="product_galleries[]" multiple class="form-control">
                            @foreach($product->galleries as $gallery)
                                <img src="{{ Storage::url($gallery->image) }}" alt="Ảnh sản phẩm" width="100">
                            @endforeach
                        </div>
                        <!-- Biến thể sản phẩm -->
                        <div class="mb-4">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Size</th>
                                    <th>Màu</th>
                                    <th>Ảnh</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product->variants as $variant)
                                    <tr>
                                        <td>
                                            <select name="product_variants[{{$variant->id}}][size]" class="form-control">
                                                @foreach($sizes as $size_id => $size_name)
                                                    <option value="{{$size_id}}"
                                                        {{ $variant->product_size_id == $size_id ? 'selected' : '' }}>{{$size_name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="product_variants[{{$variant->id}}][color]" class="form-control">
                                                @foreach($colors as $color_id => $color_name)
                                                    <option value="{{$color_id}}"
                                                        {{ $variant->product_color_id == $color_id ? 'selected' : '' }}>{{$color_name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" name="product_variants[{{$variant->id}}][image]" class="form-control">
                                            @if($variant->image)
                                                <img src="{{ Storage::url($variant->image) }}" alt="Ảnh biến thể" width="100">
                                            @endif
                                        </td>
                                        <td>
                                            <input type="text" name="product_variants[{{$variant->id}}][quantity]" class="form-control"
                                                   value="{{ old('quantity', $variant->quantity) }}">
                                        </td>
                                        <td>
                                            <input type="text" name="product_variants[{{$variant->id}}][price]" class="form-control"
                                                   value="{{ old('price', $variant->price) }}">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Nút Lưu -->
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-success w-sm">Cập nhật</button>
                </div>
            </div>
            <!-- Sidebar -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <!-- Danh mục và trạng thái sản phẩm -->
                        <div class="mb-3">
                            <label for="category-select" class="form-label">Danh mục sản phẩm</label>
                            <select class="form-control" name="category_id">
                                @foreach($categories as $id => $name)
                                    <option value="{{$id}}"
                                        {{ $product->category_id == $id ? 'selected' : '' }}>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status-select" class="form-label">Trạng thái</label>
                            <select class="form-control" name="status">
                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Không hoạt động</option>
                            </select>
                        </div>
                        <!-- Loại sản phẩm -->
                        @php
                        $types = [
                            'is_best_sale' => 'Bán chạy',
                            'is_40_sale' => 'Giảm 40%',
                            'is_hot_online' => 'Hot online',
                        ];
                    @endphp
                        <div class="mb-3">
                            <label for="product-type-checkbox" class="form-label">Loại sản phẩm</label>
                            @foreach($types as $key => $value)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="{{$key}}"
                                           id="checkbox-{{$key}}"
                                           {{ $product->$key ? 'checked' : '' }}>
                                    <label class="form-check-label" for="checkbox-{{$key}}">
                                        {{$value}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <!-- Mã sản phẩm -->
                        <div class="mb-3">
                            <label for="sku-input" class="form-label">Mã sản phẩm</label>
                            <input type="text" class="form-control" name="sku"
                                   value="{{ old('sku', $product->sku) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
