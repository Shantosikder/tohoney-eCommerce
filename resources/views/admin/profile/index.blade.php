@extends('layouts.dashboard_master')
@section('content')

    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
            <span class="breadcrumb-item active">Edit Profile</span>
        </nav>

        <div class="sl-pagebody">

            <div class="row row-sm">

                <div class="col-md-6 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Profile Edit</h3>
                        </div>
                        <div class="card-body">

                            @if (session('success_message'))
                                <div class="alert alert-success">

                                    {{ session('success_message') }}

                                </div>
                            @endif

                            <form action="{{ url('profile/post') }}" method="post">
                                @csrf
                                <div class="form-group">

                                    <label>Name</label>

                                    <input type="text" class="form-control" placeholder="Enter your Name" name="name"
                                        value="{{ Str::title(Auth::user()->name) }}">

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <button type="submit" class="btn btn-info">Change Name</button></button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-6 m-auto ">
                    <div class="card">
                        <div class="card-header">
                            <h3>Change Password</h3>
                        </div>
                        <div class="card-body">

                            @if (session('password_change_status'))
                                <div class="alert alert-success">
                                    {{ session('password_change_status') }}
                                </div>
                            @endif

                            @if ($errors->all())
                                <div class="alert alert-danger">

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            @endif

                            <form action="{{ url('password/post') }}" method="post">
                                @csrf
                                <div class="form-group">

                                    <label>Old/Current Password</label>

                                    <input type="password" class="form-control" placeholder="Enter Old/Current Password"
                                        name="old_password" value="{{ old('old_password') }}">

                                    @error('old_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group">

                                    <label>New Password</label>

                                    <input type="password" class="form-control" placeholder="Enter New Password"
                                        name="password" value="{{ old('password') }}">

                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group">

                                    <label>Confirm Password</label>

                                    <input type="password" class="form-control" placeholder="Enter Confirm Password"
                                        name="password_confirmation">

                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <button type="submit" class="btn btn-info">Change Password</button></button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
