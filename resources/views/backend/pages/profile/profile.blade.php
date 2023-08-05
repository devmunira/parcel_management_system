@extends('backend.layouts.app')

@section('content')

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-user bg-c-blue"></i>
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
    @php
        $admin = Auth::guard('admin')->user();
    @endphp
    <!-- [ breadcrumb ] end -->
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <!-- [ page content ] start -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-info text-amazon text-light">
                                <div class="card-header">
                                  <h5 class="text-light">Hello, {{ strtoupper(Auth::guard('admin')->user()->name) }}</h5>
                                </div>
                                <div class="card-block text-center">
                                    <img src="{{ asset('backend/uploads/admin/'. @$admin->profile) }}" class="rounded-circle shadow mb-1" alt="">
                                    <h4>{{ @$admin -> name }}</h4>
                                    <h6>{{ @$admin -> email }}</h6>
                                </div>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                  <h5>Password Update</h5>
                                </div>
                                <div class="card-block">
                                  <form id="main" method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Name</label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="admin_name" name="name" value="{{ old('name' , @$admin->name) }}">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="admin_email" name="email" value="{{ old('email' , @$admin->email) }}">
                                        </div>
                                      </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Profile</label>
                                      <div class="col-sm-10">
                                        <input type="file" class="form-control" id="admin_profile" name="profile">
                                        <img src="" id="admin_profile_view" alt="">
                                      </div>
                                    </div>


                                    <div class="form-group row">
                                      <label class="col-sm-2"></label>
                                      <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary m-b-0">Update Profile</button>
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

@push('script')

    <script>
        "use-strict";
        (function($){
            $(document).ready(function(){
                // profile image preview load
                imgPreview('#admin_profile' , '#admin_profile_view');
            });
        })(jQuery)

    </script>

@endpush
