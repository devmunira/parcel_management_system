@extends('backend.auth.app')

@section('content')


<form class="md-float-material form-material" method="post" action="{{ route('admin.login') }}">
    @csrf
    <div class="text-center mb-5">
        <img src="{{ asset('backend/uploads/site/'.@$general -> logo) }}" alt="logo.png" class="w-50">
    </div>
    <div class="auth-box card">

<div class="card-block">
    <div class="row m-b-20 justify-content-center">
        <div class="col-md-12">
            <h3 class="text-center txt-primary">Sign In</h3>
        </div>
    </div>

    <p class="text-muted text-center p-b-5">Sign in with your regular account</p>



    <div class="form-group form-primary">
        <input type="text" name="email" class="form-control">
        <span class="form-bar"></span>

        <label class="float-label">Email</label>

    </div>
    <div class="form-group form-primary">
        <input type="password" name="password" class="form-control" >
        <span class="form-bar"></span>

        <label class="float-label">Password</label>
    </div>
    <div class="row m-t-25 text-left">
        <div class="col-12">
            <div class="checkbox-fade fade-in-primary">
                <label>
                    <input type="checkbox" value="" name="remember">
                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                    <span class="text-inverse">Remember me</span>
                </label>
            </div>

        </div>
    </div>
    <div class="row m-t-30">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>

        </div>
    </div>

</div>
    </div>
</form>



@endsection

