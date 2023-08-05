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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card table-card">
                                <div class="card-header">
                                    <p style="font-weight: bold; color:maroon"><b>Grand Total : </b> {{ @$grand }}  &nbsp; &nbsp; <b>Shipping Charge: </b> {{ @$shipping_charge }}</p> <hr>

                                    <h5>Filter Orders</h5>
                                    <form class="d-flex mt-4" method="GET" action="{{ route('admin.report.index.daily') }}">
                                        @csrf


                                        <input type="date" name="start" class="form-control" placeholder="Start Date " id="">
                                        &nbsp;

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


                                <div class="card-block">

                                    <div class="table-responsive">
                                        <table class="table table-hover m-b-0 data-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Invoice Number</th>
                                                    <th>Customer Details</th>
                                                    <th>Product Details</th>
                                                    <th>Shipping Address</th>
                                                    <th>Delivery Method</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @forelse ($orders as $order)
                                                <tr>
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
                                                        {{ @$order -> deliverymethod -> name ? @$order -> deliverymethod -> name : 'No Method Found' }}
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

                                                        <a class="btn btn-sm btn-warning text-light" title="Order Edit"
                                                            href="{{ route('admin.order.edit' , @$order -> id) }}"><i
                                                                class="fas fa-edit"></i></a>

                                                        <a class="btn btn-sm btn-success text-light"
                                                            href="{{ route('admin.download',@$order->id) }}"
                                                            title="Order Download"><i class="fas fa-download"></i></a>

                                                        <a class="btn btn-sm btn-dark text-light" title="Order Print"
                                                            href="{{ route('order.view',[@$order -> order_number , @$order->id]) }}"><i
                                                                class="fas fa-print"></i></a>

                                                        <a class="btn btn-sm btn-danger text-light deletes_btn"
                                                            title="Order Delete" data-id={{ @$order -> id  }}
                                                            data-url={{ route('admin.order.delete') }}><i
                                                                class="fas fa-trash"></i></a>

                                                        {{-- <button id="prints" data-id={{ @$order -> id }}> Print
                                                        </button>
                                                </tr> --}}

                                                @empty
                                                    <p class="text-danger text-center">No Data Found</p>
                                                @endforelse
                                            </tbody>
                                        </table>

                                        {{ $orders -> links('vendor.custom') }}

                                    </div>
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
