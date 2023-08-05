@extends('backend.layouts.app')

@section('content')

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
                            <div class="card">
                                <div class="card-header">
                                  <h5>Password Change</h5>
                                </div>
                                <div class="card-block">
                                  <form id="main" method="post" action="{{ route('admin.password.change') }}" novalidate="">
                                    @csrf

                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Old Password</label>
                                      <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="old_password" placeholder="Old Password input">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                          <input type="password" class="form-control" id="password" name="password" placeholder="Password input">
                                        </div>
                                      </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Repeat Password</label>
                                      <div class="col-sm-10">
                                        <input type="password" class="form-control" id="repeat-password" name="password_confirmation" placeholder="Repeat Password">
                                      </div>
                                    </div>


                                    <div class="form-group row">
                                      <label class="col-sm-2"></label>
                                      <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary m-b-0">Change Password</button>
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
