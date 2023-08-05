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
                    <form action="{{ route('admin.order.update') }}" enctype="multipart/form-data" method="POST" class="OrderCreateForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card table-card">
                                    <div class="card-header">
                                        <h5>Coustomer Information</h5>
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

                                    <div class="card-body">

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label>Customer Phone Number</label>
                                                <input type="text" class="form-control customer_phone" name="phone"
                                                    placeholder="Customer Phone Number Here" value="{{ old('phone', @$order -> phone) }}">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Additional Phone Number</label>
                                                <input type="text" class="form-control customer_phone" name="ad_phone"
                                                    placeholder="Additional Phone Number Here" value="{{ old('ad_phone' , @$order -> ad_phone) }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label>Customer Shipping Addresss</label>
                                                <textarea name="address" class="form-control customer_address" rows="2"
                                                    style="width:100%;" >{{ old('address' , @$order -> address) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label>Customer Name</label>
                                                <input type="hidden" name="id" value="{{ @$order -> id }}">
                                                <input type="text" class="form-control customer_name" name="name"
                                                    placeholder="Enter Customer Name Here" value="{{ old('name' , @$order -> name) }}">
                                            </div>
                                        </div>




                                    </div>
                                </div>


                                <div class="card text-left">
                                    <div class="card-body">
                                        <div class="form-group row mb-0">
                                            <div class="col-sm-6">
                                                <label>Delivery Man</label>
                                                <select name="man" id="" class="form-control"
                                                    style="border:1px solid #ccc">
                                                    <option value="0">-- None --</option>

                                                    @foreach ($mans as $man)
                                                    <option {{ @$order -> Deliverymen_id == @$man -> id ? 'selected' : ''}}
                                                    value="{{ @$man -> id }}">{{ @$man -> name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Delivery Method</label>
                                                <select name="method" id="" class="form-control"
                                                    style="border:1px solid #ccc">
                                                    <option value="0">-- None --</option>

                                                    @foreach ($methods as $method)
                                                    <option {{ @$order -> deliverymethod_id == @$method -> id ? 'selected' : ''}}
                                                    value="{{ @$method -> id }}">{{ @$method -> name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover m-b-0">
                                                <thead class="table_head">
                                                    <tr>
                                                        <td colspan="2">Product Type</td>
                                                        <td>Quantity</td>
                                                        <td>Price</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">
                                                            <input type="text" class="form-control" name="product"
                                                            placeholder="Product Type" value="{{ old('product',@$order -> product , 'Clothing') }}">
                                                        </td>
                                                        <td> <input type="text" class="form-control" name="qnty"
                                                            placeholder="Quantity" value="{{ old('qnty',@$order -> quantity) }}"></td>
                                                        <td> <input type="text" class="form-control" name="price"
                                                            placeholder="Price" value="{{ old('price',@$order -> price) }}"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                       </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">

                                    </div>
                                    <div class="col-md-5">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <table class="table p-0 m-0 sub_table">
                                                        <tr class="sub_row">
                                                            <td class="sub_head">&nbsp;&nbsp; SubTotal:</td>
                                                            <td class="p-0 m-0"><input type="text" class="form-control" name="subtotal"
                                                                placeholder="" value="{{ @$order -> price }}" readonly></td>
                                                        </tr>
                                                        <tr class="sub_row">
                                                            <td class="sub_head">&nbsp;&nbsp; Discount:</td>
                                                            <td><input type="text" class="form-control" name="discount"
                                                                placeholder="" value="{{ old('discount' ,  @$order -> discount) }}"></td>
                                                        </tr>
                                                        <tr class="sub_row">
                                                            <td class="sub_head">&nbsp;&nbsp; Grand Total:</td>
                                                            <td><input type="text" class="form-control" name="grand_total"
                                                                placeholder="" value="{{ old('grand_total', @$order -> grand_total ) }}" readonly></td>
                                                        </tr>
                                                        <tr class="sub_row">
                                                            <td class="sub_head">&nbsp;&nbsp; Shipping Charge:</td>
                                                            <td ><input type="text" class="form-control" name="shipping"
                                                                placeholder="" value="{{ old('shipping' , @$order -> shipping_charge) }}"></td>
                                                        </tr>

                                                        <tr class="sub_row">
                                                            <td class="sub_head">&nbsp;&nbsp; Total:</td>
                                                            <td><input type="text" class="form-control" name="total"
                                                                placeholder="" value="{{ old('total', @$order -> total) }}" readonly></td>
                                                        </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="card text-left">
                                    <div class="card-body">
                                        <div class="form-group row mb-0">
                                            <div class="col-sm-12">
                                                <label>Order Status</label>
                                                <select name="status" id="" class="form-control"
                                                    style="border:1px solid #ccc" value="{{ old('status') }}">
                                                    <option {{  @$order -> status == 'Approved' ? 'selected' : ''}}
                                                        value="Approved">Approved</option>

                                                    <option {{ @$order -> status == 'Sent' ? 'selected' : ''}}
                                                        value="Sent">Sent</option>


                                                        <option {{ @$order -> status == 'Completed' ? 'selected' : ''}}
                                                        value="Completed">Completed</option>

                                                        <option {{ @$order -> status == 'Return' ? 'selected' : ''}}
                                                        value="Return">Return</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card text-left">
                                    <div class="card-body">
                                        <div class="form-group row mb-0">
                                            <div class="col-sm-12">
                                                <label>Delivery Area</label> <br>

                                                <input type="checkbox" name="area[]" id="Inside Metro" class="ps-3 ms-0 form-check-input"  value="Inside Metro" {{ is_array(@$order -> area) ? in_array('Inside Metro' , @$order -> area) ? 'Checked' : '' : '' }}><label class="form-check-label">Inside Metro</label> <br>
                                                <input type="checkbox" name="area[]" id="Outside Metro" class="ps-3 ms-0 form-check-input" value="Outside Metro" {{ is_array(@$order -> area) ? in_array('Outside Metro' , @$order -> area) ? 'Checked' : '' : '' }}><label class="form-check-label">Outside Metro</label> <br>
                                                <input type="checkbox" name="area[]" id="Outside Dhaka" class="ps-3 ms-0 form-check-input" value="Outside Dhaka" {{ is_array(@$order -> area) ? in_array('Outside Dhaka' , @$order -> area) ? 'Checked' : '' : '' }}><label class="form-check-label">Outside Dhaka</label>

                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>





                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row">

                                            <div class="col">
                                                <label for="">Comments</label> <br>
                                                <textarea name="comments" rows="3" style="width:100%;"
                                                    class="summernote">{{ old('comments' , @$order -> comments) }}</textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <label>Delivery Charge</label> <br>
                                        <input type="checkbox" name="charge[]" id="Shipping Charge Free" class="ps-3 ms-0 form-check-input charge"  value="Free" {{ in_array("Free", @$order ->delivery_method_type) ? 'Checked' : '' }}><label class="form-check-label">Shipping Charge Free</label> <br>
                                        <input type="checkbox" name="charge[]" id="COD" class="ps-3 ms-0 form-check-input" value="COD" {{ in_array("COD", @$order ->delivery_method_type) ? 'Checked' : '' }}><label class="form-check-label" >COD</label> <br>
                                        <input type="checkbox" name="charge[]" id="Paid" class="ps-3 ms-0 form-check-input" value="Paid" {{ in_array("Paid", @$order ->delivery_method_type) ? 'Checked' : '' }}><label class="form-check-label" >Paid</label>

                                        <br>
                                        <br>
                                        <input type="submit" value="Update Invoice" class="btn-coutmo text-bold font-weight-bolder shadow  btn btn-danger btn-block w-100 btn-sm text-light">


                                    </div>
                            </div>

                            </div>
                    </form>
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
