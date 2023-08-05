
<head>
    {{-- @php
      $general  = App\Models\Settings::findOrFail(1);
@endphp --}}
    <title>{{ @$general -> site_title }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ @$general -> site_seo_des['seo_des'] }}" />
    <meta name="keywords" content="{{ @$general -> site_seo_des['seo_keywords'] }}">
    <meta name="author" content="{{ @$general -> site_seo_des['seo_title'] }}" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('backend/uploads/site/'.@$general -> favicon) }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/files/bower_components/bootstrap/css/bootstrap.min.css') }}">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{ asset('backend/files/assets/pages/waves/css/waves.min.css') }}" type="text/css" media="all">
    <!-- feather icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/icon/feather/css/feather.css') }}">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/css/font-awesome-n.min.css') }}">
    <!-- Chartlist chart css -->
    <link rel="stylesheet" href="{{ asset('backend/files/bower_components/chartist/css/chartist.css') }}" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/files/bower_components/switchery/css/switchery.min.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/summernote.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-iconpicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/css/datetimepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/css/pages.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/css/widget.css') }}">
    @stack('style')
</head>
