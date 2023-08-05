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
                                    <form class="d-flex mt-4" method="GET" action="{{ route('admin.report.search') }}">
                                        @csrf

                                        <select name="area" id="" class="form-control mr-2"
                                        style="border:1px solid #ccc">
                                        <option value="">--Select Area--</option>
                                        <option value="All">All</option>
                                        <option value="Inside Metro">Inside Metro</option>
                                        <option value="Outside Metro">Outside Metro</option>
                                        <option value="Outside Dhaka">Outside Dhaka</option>

                                    </select>

                                        <input type="date" name="start" class="form-control" placeholder="Start Date " id="">
                                        &nbsp;
                                        <input type="date" name="end" class="form-control" placeholder="End Date" id="">
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
                                    <a href="{{ route('admin.order.export',  $array ) }}" class="btn btn-sm btn-primary">Excel</a>
                                    <a href="{{ route('admin.order.csv',  $array ) }}" class="btn btn-sm btn-warning">CSV</a>
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

                                             @if ($orders)
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
                                                     {{ @$order -> admin -> name ? @$order -> admin -> name : 'No officer Found' }}
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
                                             @endif
                                            </tbody>
                                        </table>
                                    </form>

                                        @if (@$orders)
                                        {{ $orders -> links('vendor.custom') }}
                                        @endif

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
