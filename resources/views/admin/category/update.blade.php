@extends('layouts.dashboard_master')

@section('category')
active
@endsection


@section('content')
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
            <a class="breadcrumb-item" href="{{ url('add/category') }}">Add Category</a>
            <span class="breadcrumb-item active">{{ $category_name }}</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm">
                <div class="col-md-4 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Update Category</h3>
                        </div>
                        <div class="card-body">

                            <form action="{{ url('update/category/post') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="hidden" name="category_id" value="{{ $category_id }}">
                                    <input type="text" class="form-control" name="category_name"
                                        value="{{ $category_name }}">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Current Category Photo</label>
                                    <img class="form-control" src="{{ asset('uploads/category_photos') }}/{{ $category_photo }}" alt="">
                                    @error('category_photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>New Category photo</label>
                                    <input type="file" class="form-control" name="new_category_photo">
                                    @error('new_category_photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-info">Update Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
