
@extends('frontend.layouts.inner_app')

@section('main')

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="{{ asset('frontend/img/bg/14.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Sign Up</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="{{ url('/') }}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Sign Up</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Register <br>Your Account</h1>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. <br>
                         Sit aliquid,  Non distinctio vel iste.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="account-login-inner">
                    <form method="POST" action="{{ route('register') }}" class="ltn__form-box contact-form-box">
                        @csrf
                        <input type="text" name="name" placeholder="First Name">
                        <input type="text" name="email" placeholder="Email*">
                        <input type="password" name="password" placeholder="Password*">
                        <input type="password" name="password_confirmation" placeholder="Confirm Password*">

                        <div class="btn-wrapper">
                            <button class="theme-btn-1 btn reverse-color btn-block" type="submit">CREATE ACCOUNT</button>
                        </div>
                    </form>
                    <div class="by-agree text-center">
                        <p>By creating an account, you agree to our:</p>
                        <p><a href="#">TERMS OF CONDITIONS  &nbsp; &nbsp; | &nbsp; &nbsp;  PRIVACY POLICY</a></p>
                        <div class="go-to-btn mt-50">
                            <a href="{{ url('/login') }}">ALREADY HAVE AN ACCOUNT ?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>

@endsection



