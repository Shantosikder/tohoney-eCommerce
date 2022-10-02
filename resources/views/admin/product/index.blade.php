@extends('layouts.dashboard_master')

@section('product')
    active
@endsection

@section('content')
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
            <span class="breadcrumb-item active">Add Product</span>
        </nav>

        <div class="sl-pagebody">

            <div class="row row-sm">
                @if (session('update_status'))
                    <div class="col-md-8">
                        <div class="alert alert-success">
                            {{ session('update_status') }}
                        </div>
                    </div>
                @endif

                @if (session('delete_status'))
                    <div class="col-md-8">
                        <div class="alert alert-warning">
                            {{ session('delete_status') }}
                        </div>
                    </div>
                @endif

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            List Product
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">

                                <thead>

                                    <tr>
                                        <th>SL No</th>
                                        <th>Product Name</th>
                                        <th>Category Name</th>
                                        <th>Product Price</th>
                                        <th>Product Quantity</th>
                                        <th>Product Photo</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->relationtocategorytable->category_name }}</td>
                                            <td>{{ $product->product_price }}</td>
                                            <td>{{ $product->product_quantity }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/product_photos') }}/{{ $product->product_thumbnail_photo }}"  alt="Not Found" width="100">
                                            </td>
                                            <td>{{ $product->created_at }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Category</h3>
                        </div>
                        <div class="card-body">

                            @if (session('success_message'))
                                <div class="alert alert-success">

                                    {{ session('success_message') }}

                                </div>
                            @endif

                            <form action="{{ url('add/product/post') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">

                                    <label>Product Name</label>

                                    <input type="text" class="form-control" placeholder="Enter Product Name"
                                        name="product_name">

                                    @error('product_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group">

                                    <label>Category Name</label>

                                    <select  class="form-control" name="category_id" id="">
                                        <option value="">Select One</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id}}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group">

                                    <label>Product Price</label>

                                    <input type="text" class="form-control" name="product_price">

                                    @error('product_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group">

                                    <label>Product Quantity</label>

                                    <input type="text" class="form-control" placeholder="Enter Product Quantity"
                                        name="product_quantity">

                                    @error('product_quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group">

                                    <label>Product Short Description</label>
                                        <textarea class="form-control" name="product_short_description" id="" rows="4"></textarea>
                                    @error('product_short_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group">

                                    <label>Product Long Description</label>
                                    <textarea class="form-control" name="product_long_description" id="" rows="4"></textarea>

                                    @error('product_long_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                {{-- -----Product photo------ --}}

                                <div class="form-group">

                                    <label>Product Thumbail Photo</label>

                                    <input type="file" class="form-control" name="product_thumbnail_photo">

                                    @error('product_thumbnail_photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>


                                       {{-- -----Product multiple photo------ --}}

                                       <div class="form-group">

                                        <label>Product Multiple Photos</label>

                                        <input type="file" class="form-control" name="product_multiple_photos[]" multiple>

                                        @error('product_thumbnail_photo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                <button type="submit" class="btn btn-success">Add Product</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
