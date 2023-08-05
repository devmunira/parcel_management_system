@extends('backend.layouts.app')

@section('content')

@php
    @$general = App\Models\Settings::findOrFail(1);
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
                                     <h5>Site Data</h5>
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

                                    <form action="{{ route('admin.settings.site.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="">Site Name</label>
                                                <input type="text" class="form-control" name="site_name" value="{{ old('site_name' , @$general -> site_title) }}">
                                            </div>
                                            <div class="col">
                                                <label for="">Site Tagline</label>
                                                <input type="text" class="form-control" name="site_tagline" value="{{ old('site_tagline' , @$general -> site_tagline) }}">
                                            </div>
                                            <div class="col">
                                                <label for="">Email</label>
                                                <input type="text" class="form-control" name="site_email" value="{{ old('site_email' , @$general -> site_email) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="">Facebook Link</label>
                                                <input type="text" class="form-control" name="fb_link" value="{{ old('fb_link' , @$general -> social_links['fb_link'] ) }}">
                                            </div>
                                            <div class="col">
                                                <label for="">Youtube Link</label>
                                                <input type="text" class="form-control" name="youtube_link" value="{{ old('youtube_link' , @$general -> social_links['youtube_link'] ) }}">
                                            </div>
                                            <div class="col">
                                                <label for="">Twitter Link</label>
                                                <input type="text" class="form-control" name="twitter_link" value="{{ old('twitter_link' , @$general -> social_links['twitter_link'] ) }}">
                                            </div>

                                            <div class="col">
                                                <label for="">RSS Link</label>
                                                <input type="text" class="form-control" name="rss_link" value="{{ old('rss_link' , @$general -> social_links['rss_link'] ) }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="">Site Address</label>
                                                <input type="text" class="form-control"  name="site_address" value="{{ old('site_address' , @$general -> site_address) }}">
                                            </div>
                                            <div class="col">
                                                <label for="">Site Phone</label>
                                                <input type="text" class="form-control" name="site_phone" value="{{ old('site_phone' , @$general -> site_phone) }}" placeholder="01811223352 | 01587463245">
                                            </div>

                                        </div>



                                        <div class="form-group row">

                                            <div class="col">
                                                <label for="">Amader Poribar Content</label> <br>
                                                <textarea name="poribar" rows="10" style="width:100%; height:150px;" class="summernote">{{ old('poribar' , @$general -> poribar) }}</textarea>
                                            </div>

                                        </div>





                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="">Site Logo</label>
                                                <input type="file" class="form-control" id="site_logo" name="site_logo">
                                                <br>
                                                <img src="{{ asset('backend/uploads/site/'.@$general -> logo) }}" style="width: 50%" id="site_logo_view" alt="">
                                            </div>

                                            <div class="col">
                                                <label for="">Site Favicon</label>
                                                <input type="file" class="form-control" id="site_favicon" name="site_favicon">
                                                <br>
                                                <img src="{{ asset('backend/uploads/site/'.@$general -> favicon) }}" style="width: 40px"  id="site_favicon_view" alt="">
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
