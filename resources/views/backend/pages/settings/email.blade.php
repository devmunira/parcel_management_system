@extends('backend.layouts.app')

@section('content')

@php
    $general = App\Models\Settings::findOrFail(1);

@endphp
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-lock bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __(@$pageTitle) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">{{ __(@$pageTitle)}}</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <!-- [ page content ] start -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card table-card">
                                <div class="card-header">
                                     <h5>Email Data</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                            <li><i class="feather icon-trash close-card"></i></li>
                                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">

                                    <form action="{{ route('admin.settings.email.store') }}" method="POST" >
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="">SMTP Host</label>
                                                <input type="text" class="form-control" name="smtp_host" value="{{ old('smtp_host' , @$general -> email_method['smtp_host']) }}">
                                            </div>
                                            <div class="col">
                                                <label for="">SMTP PORT</label>
                                                <input type="text" class="form-control" name="smtp_port" value="{{ old('smtp_port' , @$general -> email_method['smtp_port']) }}">
                                            </div>
                                            <div class="col">
                                                <label for="">Encryption</label>
                                                <input type="text" class="form-control" name="encryption" value="{{ old('encryption' , @$general -> email_method['encryption']) }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="">User Name</label>
                                                <input type="text" class="form-control"  name="user_name" value="{{ old('user_name' , @$general -> email_method['user_name']) }}">
                                            </div>
                                            <div class="col">
                                                <label for="">Password</label>
                                                <input type="password" class="form-control" name="password" value="{{ old('password' , @$general -> email_method['password']) }}" >
                                            </div>

                                        </div>





                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary">Update Email Settings</button>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- [ page content ] end -->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- [ style Customizer ] start -->
<div id="styleSelector">
</div>
<!-- [ style Customizer ] end -->


@endsection

