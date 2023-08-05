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
                            <div class="card table-card">
                                <div class="card-header">
                                     <h5>Signature</h5>
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
                                <div class="card-body">

                                    <form action="{{ route('admin.signaturestore') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="">Signature</label>
                                                <input type="file" class="form-control" id="site_logo" name="signature">
                                                <br>
                                                <img src="{{ asset('backend/uploads/site/'.@$general -> signature) }}" style="width: 50%" id="site_logo_view" alt="">
                                            </div>



                                        </div>



                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary">Update Site Settings</button>
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
                imgPreview('#site_logo' , '#site_logo_view');

                imgPreview('#site_favicon' , '#site_favicon_view');

                imgPreview('#bannar' , '#site_bannar_view' , '100%' , '200px');



            });
        })(jQuery)

    </script>



@endpush
