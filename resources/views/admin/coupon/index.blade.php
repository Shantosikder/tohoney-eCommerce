@extends('layouts.dashboard_master')

@section('coupon')
    active
@endsection

@section('content')
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
            <span class="breadcrumb-item active">Add Coupon</span>
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
                            List Coupon
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">

                                <thead>

                                    <tr>
                                        <th>SL No</th>
                                        <th>Coupon Name</th>
                                        <th>Discount Amount (%)</th>
                                        <th>Validity Till</th>
                                        <th>validaty_Status</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>

                                <tbody>

                                     @foreach ($coupons as $coupon)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $coupon->coupon_name }}</td>
                                            <td>{{ $coupon->discount_amount }}%</td>
                                            <td>{{ $coupon->validaty_till }}</td>
                                            <td>
                                                @if ( $coupon->validaty_till >= \Carbon\Carbon::now()->format('Y-m-d'))
                                                <span class="badge badge-success">Valid</span>
                                                @else
                                                <span class="badge badge-danger">Invalid</span>
                                                @endif

                                            </td>
                                            <td>{{ $coupon->created_at }}</td>

                                            {{-- <td>
                                                <img src="{{ asset('uploads/product_photos') }}/{{ $product->product_thumbnail_photo }}"  alt="Not Found" width="100">
                                            </td>
                                            <td>{{ $coupon->created_at }}</td>
                                        </tr> --}}

                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Coupon</h3>
                        </div>
                        <div class="card-body">

                            @if (session('success_message'))
                                <div class="alert alert-success">

                                    {{ session('success_message') }}

                                </div>
                            @endif

                            <form action="{{ url('add/coupon/post') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">

                                    <label>Coupon  Name</label>

                                    <input type="text" class="form-control"
                                        name="coupon_name">

                                    @error('coupon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">

                                    <label>Discount Amount (%)</label>

                                    <input type="text" class="form-control"
                                        name="discount_amount">

                                    @error('discount_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group">

                                    <label>Validity Till</label>

                                    <input type="date" class="form-control"
                                        name="validaty_till" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

                                    @error('validaty_till')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <button type="submit" class="btn btn-success">Add Coupon</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
