@extends('backend.auth.app')

@section('content')
@php
$general  = App\Models\Settings::findOrFail(1);
@endphp

<form class="md-float-material form-material" method="post" action="{{ route('admin.code') }}">
    @csrf
    <div class="text-center mb-5">
        <img src="{{ asset('backend/uploads/site/'.@$general -> logo) }}" alt="logo.png" class="w-50">
    </div>
    <div class="auth-box card">

<div class="card-block">
    <div class="row m-b-20 justify-content-center">
        <div class="col-md-12">
            <h3 class="text-center txt-primary">Email Verification</h3>
        </div>
    </div>


    <div class="form-group form-primary">
        <input type="text" name="email" class="form-control">
        <span class="form-bar"></span>
        <label class="float-label">Email</label>

    </div>

    <div class="row m-t-30">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Email Verify</button>

        </div>
    </div>

</div>
    </div>
</form>



@endsection
