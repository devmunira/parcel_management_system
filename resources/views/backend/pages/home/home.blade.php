@extends('backend.layouts.app')

@section('content')
<div class="pcoded-content">

    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-home bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Dashboard</h5>
                        {{-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">

                    <div class="row">

                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-red">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Today Total Parcel</h6>
                                            <h3 class="m-b-0 f-w-700 text-white"> {{ @$grand }} </h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-alt text-c-red f-18"></i>
                                        </div>
                                    </div>
                                    {{-- <p class="m-b-0 text-white"><span class="label label-danger m-r-10">+11%</span>From
                                        Previous Month</p> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-blue">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Orders</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{ @$orders }}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-database text-c-blue f-18"></i>
                                        </div>
                                    </div>
                                    {{-- <p class="m-b-0 text-white"><span class="label label-primary m-r-10">+12%</span>From
                                        Previous Month</p> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-green">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Grand Total</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{ @$avg }} BDT</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign text-c-green f-18"></i>
                                        </div>
                                    </div>
                                    {{-- <p class="m-b-0 text-white"><span class="label label-success m-r-10">+52%</span>From
                                        Previous Month</p> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-yellow">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Product Sold</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{ @$product_sold }}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tags text-c-yellow f-18"></i>
                                        </div>
                                    </div>
                                    {{-- <p class="m-b-0 text-white"><span class="label label-warning m-r-10">+52%</span>From
                                        Previous Month</p> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-yellow">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Inside Metro</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{ @$inside_metro }}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tags text-c-yellow f-18"></i>
                                        </div>
                                    </div>
                                    {{-- <p class="m-b-0 text-white"><span class="label label-warning m-r-10">+52%</span>From
                                        Previous Month</p> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-green">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Outside Metro</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{ @$outside_metro }}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign text-c-green f-18"></i>
                                        </div>
                                    </div>
                                    {{-- <p class="m-b-0 text-white"><span class="label label-success m-r-10">+52%</span>From
                                        Previous Month</p> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-blue">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Outside Dhaka</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{ @$outside_dhaka }}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-database text-c-blue f-18"></i>
                                        </div>
                                    </div>
                                    {{-- <p class="m-b-0 text-white"><span class="label label-primary m-r-10">+12%</span>From
                                        Previous Month</p> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-red">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Shipping Charge</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{ @$shipping_charge }} BDT</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-alt text-c-red f-18"></i>
                                        </div>
                                    </div>
                                    {{-- <p class="m-b-0 text-white"><span class="label label-danger m-r-10">+11%</span>From
                                        Previous Month</p> --}}
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-12">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-25">Total Return Order</h6>
                                            <h3 class="f-w-700 text-c-blue">{{ @$total_return }}</h3>
                                            {{-- <p class="m-b-0">May 23 - June 01 (2017)</p> --}}
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-eye bg-c-blue"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-25">Approved Order</h6>
                                            <h3 class="f-w-700 text-c-green">{{ @$total_approved }}</h3>
                                            {{-- <p class="m-b-0">May 23 - June 01 (2017)</p> --}}
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bullseye bg-c-green"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-25">Total Sent Order</h6>
                                            <h3 class="f-w-700 text-c-yellow">{{ @$total_sent }}</h3>
                                            {{-- <p class="m-b-0">May 23 - June 01 (2017)</p> --}}
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-hand-paper bg-c-yellow"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-25">completed Order</h6>
                                            <h3 class="f-w-700 text-c-yellow">{{ @$completed }}</h3>
                                            {{-- <p class="m-b-0">May 23 - June 01 (2017)</p> --}}
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-hand-paper bg-c-yellow"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-md-12">
                            <div class="card latest-update-card">
                                <div class="card-header">
                                    <h5>Today Have to Delivery</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i
                                                    class="feather icon-chevron-left open-card-option"></i></li>
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                            <li><i class="feather icon-trash close-card"></i></li>
                                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="slimScrollDiv"
                                        style="position: relative; overflow: hidden; width: auto; height: 290px;">
                                        <div class="scroll-widget"
                                            style="overflow: hidden; width: auto; height: 290px;">
                                            <div class="latest-update-box">
                                                @forelse ($today as $today)
                                                <div class="row p-t-20 p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="b-danger update-icon ring"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!">
                                                            <h6>Order Invoice Number : {{ @$today -> order_number }}</h6>
                                                        </a>
                                                        <p class="text-muted m-b-0">Ship to : {{ @$today -> address }}</p>
                                                    </div>
                                                </div>
                                                @empty
                                                <div class="row p-t-20 p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="b-success update-icon ring"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!">
                                                            <h6>Great Job! No Pending Parcel Found.</h6>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="slimScrollBar"
                                            style="background: rgb(0, 0, 0); width: 5px; position: absolute; top: 104px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 186.475px;">
                                        </div>
                                        <div class="slimScrollRail"
                                            style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>

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
