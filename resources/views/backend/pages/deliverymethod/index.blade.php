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
                        <div class="col-md-8">
                            <div class="card table-card">
                                <div class="card-header">
                                     <h5>Delivery Method List</h5>
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
                                    <div class="table-responsive">
                                        <table class="table table-hover m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               @forelse ($methods as $me)
                                               <tr>
                                                <td>{{ $loop -> iteration }}</td>
                                                <td>{!! @$me -> name !!}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-warning text-light deliverymethod_edit" title="Edit" data-id={{ @$me -> id  }} data-url={{ route('admin.delivery.method.update') }}><i class="fas fa-edit"></i></a>
                                                    <a class="btn btn-sm btn-danger text-light deletes_btn" title="Delete" data-id={{ @$me -> id  }} data-url={{ route('admin.delivery.method.delete') }}><i class="fas fa-trash"></i></a>
                                             </td>
                                            </tr>
                                               @empty

                                               @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{ $methods -> links('vendor.custom') }}
                        </div>
                        <div class="col-md-4">
                            <div class="card text-left">
                              <div class="card-body">
                                <h4 class="card-title">Add Method</h4>
                                <br>
                                <form id="main" method="post" action="{{ route('admin.delivery.method.store') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                          <input type="text" class="form-control"  name="name" placeholder="Name" value="{{ old('name') }}">
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <div class="col-sm-12">
                                          <button type="submit" class="btn btn-primary m-b-0">Add</button>
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

<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="deliveryMethodModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">{{__('Edit Delivery Method')}}</h5>
                <button type="button" class="close ticket-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-12">
                          <input type="text" class="form-control"  name="name" placeholder="Name" value="{{ old('name') }}">
                          <input type="hidden" name="id">
                        </div>
                      </div>


                        <div class="form-group row">
                          <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary m-b-0">Update</button>
                          </div>
                        </div>

                </form>
            </div>

        </div>
    </div>
</div>


@endsection


@push('script')

    <script>
        "use-strict";
        (function($){
            $(document).ready(function(){

                $('.cat_delete').click(function(e){
                    e.preventDefault();
                    const deletemodal = $('#deleteModal');
                    deletemodal.find('form').attr('action' , $(this).data('url'))
                    deletemodal.find('input[name="id"]').val($(this).data('id'))
                    deletemodal.modal('show');
                })


                $('.cat_edit').click(function(e){
                    e.preventDefault();
                    const modal =  $('#tagModal');
                    modal.find('form').attr('action', $(this).data('url'));
                    let id = $(this).data('id');
                    $.ajax({
                        url: 'tag/' + id,
                        success: function(output){
                            modal.find('input[name="name"]').val(output.name)
                            modal.find('input[name="id"]').val(output.id)
                            modal.modal('show');

                        }
                    })
                });



            });
        })(jQuery)

    </script>

@endpush
