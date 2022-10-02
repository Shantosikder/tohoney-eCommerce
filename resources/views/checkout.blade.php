@extends('layouts.frontend_master')

@section('frontend_content')

<div class="responsive-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-12 d-block d-lg-none">
                <ul class="metismenu">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li class="sidemenu-items">
                        <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Shop </a>
                        <ul aria-expanded="false">
                            <li><a href="shop.html">Shop Page</a></li>
                            <li><a href="single-product.html">Product Details</a></li>
                            <li><a href="cart.html">Shopping cart</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li><a href="wishlist.html">Wishlist</a></li>
                        </ul>
                    </li>
                    <li class="sidemenu-items">
                        <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Pages </a>
                        <ul aria-expanded="false">
                          <li><a href="about.html">About Page</a></li>
                          <li><a href="single-product.html">Product Details</a></li>
                          <li><a href="cart.html">Shopping cart</a></li>
                          <li><a href="checkout.html">Checkout</a></li>
                          <li><a href="wishlist.html">Wishlist</a></li>
                          <li><a href="faq.html">FAQ</a></li>
                        </ul>
                    </li>
                    <li class="sidemenu-items">
                        <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Blog</a>
                        <ul aria-expanded="false">
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="blog-details.html">Blog Details</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- responsive-menu area start -->
</div>
</header>
<!-- header-area end -->
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
<div class="container">
  <div class="row">
      <div class="col-12">
          <div class="breadcumb-wrap text-center">
              <h2>Checkout</h2>
              <ul>
                  <li><a href="index.html">Home</a></li>
                  <li><span>Checkout</span></li>
              </ul>
          </div>
      </div>
  </div>
</div>
</div>
<!-- .breadcumb-area end -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
<div class="container">
  <div class="row">
      <div class="col-lg-8">
          <div class="checkout-form form-style">
              <h3>Billing Details</h3>
              <form method="POST" action="{{ url('checkout/post') }}">
                @csrf
                  <div class="row">
                      <div class="col-12">
                          <p>Full Name</p>
                          <input type="text" value="{{ Auth::user()->name }}" name="full_name" required>
                      </div>
                      <div class="col-sm-6 col-12">
                          <p>Email Address *</p>
                          <input type="email" value="{{ Auth::user()->email }}" name="email" required>
                      </div>
                      <div class="col-sm-6 col-12">
                          <p>Phone No. *</p>
                          <input type="text" name="phone_number" required>
                      </div>
                      <div class="col-12">
                          <p>Country *</p>
                          <input type="text" name="country" required>
                      </div>
                      <div class="col-12">
                          <p>Your Address *</p>
                          <input type="text" name="address" required>
                      </div>
                      <div class="col-sm-6 col-12">
                          <p>Postcode/ZIP</p>
                          <input type="text" name="post_code" required>
                      </div>
                      <div class="col-sm-6 col-12">
                          <p>Town/City *</p>
                          <input type="text" name="city" required>
                      </div>
                      <div class="col-12">
                          <p>Order Notes </p>
                          <textarea name="notes" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                      </div>
                  </div>
          </div>
      </div>
      <div class="col-lg-4">
          <div class="order-area">
              <h3>Your Order</h3>
              <ul class="total-cost">

                @php
                $sub_total = 0;
                @endphp

                @foreach ($carts as $cart)
                <li>{{ App\Product::find($cart->product_id)->product_name }} X {{ $cart->quantity }}<span class="pull-right">${{ App\Product::find($cart->product_id)->product_price * $cart->quantity }}</span></li>
                @php
                $sub_total = $sub_total + ( App\Product::find($cart->product_id)->product_price * $cart->quantity);
                @endphp
                @endforeach
                  <li>Subtotal <span class="pull-right"><strong>${{ $sub_total }}</strong></span></li>
                  <input type="hidden" name="sub_total" value="{{ $sub_total }}">
                  <input type="hidden" name="total" value="{{ $total }}">
                  <li>Total<span class="pull-right">${{ $total }}</span></li>
              </ul>
              <ul class="payment-method">
                <li>
                    <input id="delivery" type="radio" name="payment_option" value="1" checked>
                    <label for="delivery">Cash on Delivery</label>
                </li>

                  <li>
                      <input id="card" type="radio" name="payment_option" value="2">
                      <label for="card">Credit Card</label>
                  </li>
              </ul>
              <button type="submit">Place Order</button>
            </form>
          </div>
      </div>
  </div>
</div>
</div>
<!-- checkout-area end -->

@endsection
