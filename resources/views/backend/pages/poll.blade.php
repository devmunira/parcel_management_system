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
                                    <h5>Poll List</h5>
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
                                        <table class="table table-hover m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Poll Question</th>
                                                    <th>Option One</th>
                                                    <th>Option Two</th>
                                                    <th>Total Vote</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($poll as $pol )
                                                <tr>
                                                    <td>{{ $loop -> iteration }}</td>
                                                    <td>{{ @$pol -> question }}</td>
                                                    <td>{{ @$pol -> option_one }} <br> <span
                                                            class="badge badge-primary">{{ __('Vote:') }}{{  @$pol -> vote_one }}</span>
                                                    </td>
                                                    <td>{{ @$pol -> option_two }} <br> <span
                                                            class="badge badge-primary">{{ __('Vote:') }}{{  @$pol -> vote_two }}</span>
                                                    </td>

                                                    <td><span class="badge badge-danger">{{ @$pol -> total }}</span>
                                                    </td>
                                                    <td><span
                                                            class="badge badge-{{ @$pol -> status ? 'success' : 'warning' }}">{{ @$pol -> status ? 'Published' : 'Pending' }}</span>
                                                    </td>

                                                    <td>
                                                        <a href="#!" data-modal="modal-1"
                                                            data-url="{{ url('/admin/poll/update') }}" class="pol_edit"
                                                            data-id="{{ @$pol -> id }}"><i
                                                                class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a>

                                                        <a href="#!" class="pol_delete"
                                                            data-url="{{ url('admin/poll/delete') }}"
                                                            data-id="{{ @$pol -> id }}"><i
                                                                class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                                    </td>
                                                </tr>

                                                @empty

                                                @endforelse




                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-block">

                                    <form action="{{ route('admin.poll.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="">Question</label>
                                                <input type="text" class="form-control" name="question"
                                                    value="{{ old('question') }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="">Option 1</label>
                                                <input type="text" class="form-control" name="option_one"
                                                    value="{{ old('option_one') }}">
                                            </div>
                                            <div class="col">
                                                <label for="">Option 2</label>
                                                <input type="text" class="form-control" name="option_two"
                                                    value="{{ old('option_two') }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col">
                                                <div class="checkbox-color checkbox-primary">
                                                    <input id="checkbox18" type="checkbox" name="status" value="true">
                                                    <label for="checkbox18">
                                                        Publish Now
                                                    </label>
                                                </div>
                                            </div>

                                        </div>



                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-primary">Craete Poll </button>
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
<div class="modal fade" tabindex="-1" role="dialog" id="pollModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">{{__('Edit Poll')}}</h5>
                <button type="button" class="close ticket-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col">
                            <label for="">Question</label>
                            <input type="text" class="form-control" name="question" value="{{ old('question') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="">Option 1</label>
                            <input type="text" class="form-control" name="option_one" value="{{ old('option_one') }}">
                        </div>
                        <div class="col">
                            <label for="">Option 2</label>
                            <input type="text" class="form-control" name="option_two" value="{{ old('option_two') }}">
                            <input type="hidden" name="id">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <div class="checkbox-color checkbox-primary">
                                <input id="checkbox181" type="checkbox" name="status" value="true">
                                <label for="checkbox181">
                                    Publish Now
                                </label>
                            </div>
                        </div>

                    </div>



                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Update Poll </button>
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
    (function ($) {
        $(document).ready(function () {

            $('.pol_delete').click(function (e) {
                e.preventDefault();
                const deletemodal = $('#deleteModal');
                deletemodal.find('form').attr('action', $(this).data('url'))
                deletemodal.find('input[name="id"]').val($(this).data('id'))
                deletemodal.modal('show');
            })


            $('.pol_edit').click(function (e) {
                e.preventDefault();
                const modal = $('#pollModal');
                modal.find('form').attr('action', $(this).data('url'));
                let id = $(this).data('id');
                $.ajax({
                    url: 'poll/edit/'+ id,
                    success: function (output) {
                        modal.find('input[name="question"]').val(output.question)
                        modal.find('input[name="option_one"]').val(output.option_one)
                        modal.find('input[name="option_two"]').val(output.option_two)
                        modal.find('input[name="id"]').val(output.id)
                        modal.modal('show');
                        if(output.status){
                            modal.find('input[name="status"]').attr('checked', 'checked');
                        }
                    }
                })
            });



        });
    })(jQuery)

</script>

@endpush
