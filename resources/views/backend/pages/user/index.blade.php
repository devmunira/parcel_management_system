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
                                     <h5>User List</h5>
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
                                                    <th>User Contact</th>
                                                    <th>Access</th>
                                                    <th>Photo</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($users as $user )
                                                <tr>
                                                    <td>{{ $loop -> iteration }}</td>
                                                    <td>{!! @$user -> name !!}</td>
                                                    <td>
                                                        {{ @$user -> email }}
                                                    </td>


                                                    <td>

                                                        @if (@$user -> orders)
                                                            <span class="badge badge-primary">{{ __('Order') }}</span>
                                                        @endif

                                                        @if (@$user -> Deliverymen)
                                                        <span class="badge badge-info">{{ __('Delivery Man') }}</span>
                                                        @endif

                                                        @if (@$user -> deliverymethod)
                                                        <span class="badge badge-warning">{{ __('Delivery Method') }}</span>
                                                        @endif

                                                      <br>

                                                        @if (@$user -> user)
                                                        <span class="badge badge-success">{{ __('User') }}</span>
                                                        @endif

                                                        @if (@$user -> cache)
                                                        <span class="badge badge-dark">{{ __('Cache') }}</span>
                                                        @endif


                                                        @if (@$user -> database_backup)
                                                        <span class="badge badge-danger">{{ __('Database') }}</span>
                                                        @endif



                                                    </td>


                                                    <td>
                                                        <img src="{{ @$user -> profile ?  asset('backend/uploads/admin/'.@$user -> profile) : asset('uploads/placeholder/image_preview.jpg') }}" style="width:50px;">
                                                    </td>



                                                    <td>
                                                        <a href="#!" data-modal="modal-1" data-url="{{ url('/admin/user/update') }}" class="user_edit" data-id="{{ @$user -> id }}" data-slug="{{ @$user -> slug }}"><i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a>

                                                        <a href="#!" class="user_delete" data-url="{{ url('admin/user/delete') }}" data-id="{{ @$user -> id }}"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                                    </td>
                                                </tr>

                                                @empty

                                                @endforelse




                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{ $users -> links('vendor.custom') }}
                        </div>
                        <div class="col-md-4">
                            <div class="card text-left">
                              <div class="card-body">
                                <h4 class="card-title">Add User</h4>
                                <br>
                                <form id="main" method="post" action="{{ route('admin.role.store') }}" enctype="multipart/form-data">
                                    @csrf
                                      <div class="form-group row">
                                        <div class="col-sm-12">
                                          <input type="text" class="form-control"  name="name" placeholder="User Name" value="{{ old('name') }}">
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <div class="col-sm-12">
                                          <input type="text" class="form-control"  name="email" placeholder="User Email" value="{{ old('email') }}">
                                        </div>
                                      </div>




                                      <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="checkbox" name="orders" id="orders" value=1>&nbsp;<label for="orders">{{ __('Order') }}</label>
                                            <input type="checkbox" value=1 name="Deliverymen" id="Deliverymen">&nbsp;<label for="Deliverymen">{{ __('Delivery Man') }}</label>
                                            <input type="checkbox" value=1 name="deliverymethod" id="deliverymethod">&nbsp;<label for="deliverymethod">{{ __('Delivery Method') }}</label> <br>
                                            <input type="checkbox" value=1 name="user" id="user">&nbsp;<label for="user">{{ __('user') }}</label>
                                            <input type="checkbox" value=1 name="database_backup" id="database_backup">&nbsp;<label for="database_backup">{{ __('database_backup') }}</label>
                                            <input type="checkbox" value=1 name="cache" id="cache">&nbsp;<label for="cache">{{ __('cache') }}</label>
                                        </div>
                                      </div>


                                      <div class="form-group row">
                                        <div class="col-sm-12">
                                          <button type="submit" class="btn btn-primary m-b-0">Add User</button>
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
<div class="modal fade" tabindex="-1" role="dialog" id="userModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">{{__('Edit User')}}</h5>
                <button type="button" class="close ticket-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="main" method="post" action="">
                    @csrf
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <input type="text" class="form-control"  name="name" placeholder="User Name" value="{{ old('name') }}">
                          <input type="hidden" name="id">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-12">
                          <input type="text" class="form-control"  name="email" placeholder="User Email" value="{{ old('email') }}">
                        </div>
                      </div>




                      <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="checkbox" value=1 name="orders" id="orders">&nbsp;<label for="orders">{{ __('Order') }}</label>
                            <input type="checkbox" value=1 name="Deliverymen" id="Deliverymen">&nbsp;<label for="Deliverymen">{{ __('Delivery Man') }}</label>
                            <input type="checkbox" value=1 name="deliverymethod" id="deliverymethod">&nbsp;<label for="deliverymethod">{{ __('Delivery Method') }}</label><br>
                            <input type="checkbox" value=1 name="user" id="user">&nbsp;<label for="user">{{ __('user') }}</label>
                            <input type="checkbox" value=1 name="database_backup" id="database_backup">&nbsp;<label for="database_backup">{{ __('database_backup') }}</label>
                            <input type="checkbox" value=1 name="cache" id="cache">&nbsp;<label for="cache">{{ __('cache') }}</label>
                        </div>
                      </div>


                      <div class="form-group row">
                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-primary m-b-0">Update User</button>
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

                $('.user_delete').click(function(e){
                    e.preventDefault();
                    const deletemodal = $('#deleteModal');
                    deletemodal.find('form').attr('action' , $(this).data('url'))
                    deletemodal.find('input[name="id"]').val($(this).data('id'))
                    deletemodal.modal('show');
                })


                $('.user_edit').click(function(e){
                    e.preventDefault();
                    const modal =  $('#userModal');
                    modal.find('form').attr('action', $(this).data('url'));
                    let id = $(this).data('id');
                    $.ajax({
                        url: 'user/' + id,
                        success: function(output){
                            modal.find('input[name="name"]').val(output.name)
                            modal.find('input[name="id"]').val(output.id)
                            modal.find('input[name="email"]').val(output.email)
                            if(output.orders != null){
                                modal.find('input[name="orders"]').attr('checked','checked')
                            }
                            if(output.Deliverymen != null){
                                modal.find('input[name="Deliverymen"]').attr('checked','checked')
                            }

                            if(output.deliverymethod != null){
                                modal.find('input[name="deliverymethod"]').attr('checked','checked')
                            }

                            if(output.user != null){
                                modal.find('input[name="user"]').attr('checked','checked')
                            }
                           if(output.database_backup != null){
                                modal.find('input[name="database_backup"]').attr('checked','checked')
                            }
                            if(output.cache != null){
                                modal.find('input[name="cache"]').attr('checked','checked')
                            }


                            modal.modal('show');


                        }
                    })
                });



            });
        })(jQuery)

    </script>

@endpush
