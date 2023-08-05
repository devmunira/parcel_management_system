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
                                    <p style="font-weight: bold; color:maroon"><b>Grand Total : </b> {{ @$grand }}  &nbsp; &nbsp; <b>Shipping Charge: </b> {{ @$shipping_charge }}</p> <hr>

                                    <h5>Filter Orders</h5>
                                    <form class="d-flex mt-4" method="GET" action="{{ route('admin.order.trash.search') }}">
                                        @csrf
                                        <select name="status" id="" class="form-control mr-2"
                                            style="border:1px solid #ccc">
                                            <option value="">--Order Status--</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Sent">Sent</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Return">Return</option>
                                        </select>

                                        {{-- <select name="area" id="" class="form-control mr-2"
                                        style="border:1px solid #ccc">
                                        <option value="">--Select Area--</option>
                                        <option value="Inside Dhaka">Inside Metro</option>
                                        <option value="Outside Dhaka">Outside Metro</option>
                                        <option value="Outside Dhaka">Outside Dhaka</option>

                                    </select> --}}


                                        <select name="method" id="" class="form-control mr-2"
                                            style="border:1px solid #ccc">
                                            <option value="">--Delivery Method--</option>
                                            @foreach ($methods as $method)
                                            <option value="{{ @$method -> id }}">{{ @$method -> name }}</option>
                                            @endforeach
                                        </select>

                                        <select name="man" id="" class="form-control mr-2"
                                            style="border:1px solid #ccc">
                                            <option value="">--Delivery Man--</option>
                                            @foreach ($mans as $man)
                                            <option value="{{ @$man -> id }}">{{ @$man -> name }}></option>
                                            @endforeach
                                        </select>

                                        {{-- <input type="date" name="" class="form-control" placeholder="Start Date " id="">
                                        &nbsp;
                                        <input type="date" name="" class="form-control" placeholder="End Date" id="">
                                        &nbsp; --}}

                                        <input type="search" name="search" class="form-control"
                                            placeholder="Search Order Number..." id=""> &nbsp;

                                        <input type="search" name="number" class="form-control"
                                            placeholder="Search Phone Number..." id="">

                                        <input type="submit" value="Search Now" class="btn btn-sm btn-primary ml-2">
                                    </form>
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

                                @php
                                $array = [];
                            @endphp
                            @foreach ($orders as $order)
                               @php
                                    array_push($array , $order -> id)
                               @endphp
                            @endforeach

                            <div class="card-block">
                               &nbsp; &nbsp; <form action="{{ route('admin.print.all.view') }}" method="GET" class="d-inline justify-content-end pe-5 me-5 text-right float-lg-end ms-5 ">
                                    <input type="submit" value="Print All" class="btn btn-sm btn-danger">
                                    <a href="{{ route('admin.order.trash.export',  $array ) }}" class="btn btn-sm btn-primary">Excel</a>
                                    <a href="{{ route('admin.order.trash.csv',   $array ) }}" class="btn btn-sm btn-warning">CSV</a>
                                    <br>
                                    <br>



                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-left">
                                                <tr>
                                                    <th>#</th>
                                                    <th>SL</th>
                                                    <th>Invoice</th>
                                                    <th>Customer</th>
                                                    <th>Product</th>
                                                    <th>SA</th>
                                                    <th>Officer</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-left">

                                                @forelse ($orders as $order)
                                                <tr>
                                                    <td><input type="checkbox" name="ids[]" class="printids" checked value="{{ @$order -> id }}" class="form-control" id=""></td>
                                                    <td>{{ @$loop -> iteration }}</td>
                                                    <td>{{ @$order -> order_number }}</td>
                                                    <td>
                                                        <h6>{{ @$order -> name }}</h6>
                                                        <p>{{ @$order -> phone }}</p>
                                                        <p>{{ @$order -> ad_phone ?  @$order -> ad_phone  : ''}}</p>
                                                    </td>

                                                    <td>
                                                        <h6>{{ @$order -> product }}</h6>
                                                        <p><b>Quantity:</b>{{ @$order -> quantity }}</p>
                                                        <p><b>Price:</b>{{ @$order -> price }}</p>
                                                    </td>
                                                    <td>{{ @$order -> address ? Str::limit(@$order -> address, 20, '...') : 'No Address Found' }}
                                                    </td>
                                                    <td>
                                                        {{ @$order -> admin -> name ? @$order -> admin -> name : 'No Officer Found' }}
                                                    </td>
                                                    <td>
                                                        <div class="form-group row mb-0">
                                                        <select name="status" id="" class="form-control status-update"
                                                            style="border:1px solid #ccc" data-id="{{ @$order -> id }}">
                                                            <option {{ @$order -> status == 'Approved' ? 'selected' : ''}}
                                                                value="Approved">Approved</option>

                                                            <option {{ @$order -> status == 'Sent' ? 'selected' : ''}}
                                                                value="Sent">Sent</option>


                                                            <option {{ @$order -> status == 'Completed' ? 'selected' : ''}}
                                                                value="Completed">Completed</option>

                                                            <option {{ @$order -> status == 'Return' ? 'selected' : ''}}
                                                                value="Return">Return</option>
                                                        </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-light" title="Order View"
                                                            href="{{ url('/order_invoice/'. @$order -> order_number .'/'. @$order -> id) }}"><i
                                                                class="fas fa-eye"></i></a>

                                                        <a class="btn btn-sm btn-success text-light"
                                                            href="{{ route('admin.download',@$order->id) }}"
                                                            title="Order Download"><i class="fas fa-download"></i></a>

                                                            <a class="btn btn-sm btn-dark text-light" title="Order Print"
                                                            href="{{ route('order.view',[@$order -> order_number , @$order->id]) }}"><i
                                                                class="fas fa-print"></i></a>

                                                        <a class="btn btn-sm btn-danger text-light deletes_btn"
                                                            title="Order Permanently Delete" data-id={{ @$order -> id  }}
                                                            data-url={{ route('admin.order.forcedelete') }}><i
                                                                class="fas fa-trash"></i></a>

                                                        <a class="btn btn-sm btn-success text-light restore_btn"
                                                        title="Order Restore" data-id={{ @$order -> id  }}
                                                        ><i
                                                            class="fas fa-recycle"></i></a>



                                                @empty
                                                    <p class="text-danger text-center">No Data Found</p>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </form>


                                        {{ $orders -> links('vendor.custom') }}

                                    </div>
                                </div>
                            </div>


                        </div>

                        <form action="{{ route('admin.order.restore') }}" method="POST" class="d-none resore_form">
                            @csrf
                            <input type="hidden" name="id">
                            <input type="submit" value="">
                        </form>

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
