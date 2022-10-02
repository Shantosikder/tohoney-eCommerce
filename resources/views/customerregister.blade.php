@extends('layouts.frontend_master')

@section('frontend_content')
 <!-- checkout-area start -->
 <div class="account-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                <div class="account-form form-style">
                    <form method="post" action="{{ url('customer/register/post') }}">
                        @csrf
                    <p>Full Name *</p>
                    <input type="text" name="name">
                    <p>Email Address *</p>
                    <input type="email" name="email">
                    <p>Password *</p>
                    <input type="password" name="password">
                    <p>Confirm Password *</p>
                    <input type="password" name="confirm_password">
                    <button type="submit">Register</button>
                    </form>
                    <div class="text-center">
                        <a href="{{ url('login') }}">Or Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
@endsection
