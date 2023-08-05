<!DOCTYPE html>
<html>

    @include('backend.partials.head')
<body>
   @include('backend.partials.preloader')
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
           @include('backend.layouts.header')
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                   @include('backend.layouts.sidebar')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">{{__('Delete Confirmation')}}</h5>
                <button type="button" class="close ticket-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <p class="text-dark">{{__('Are You Sure To Delete this Data')}}?</p>

                    <div class="d-flex justify-content-end text-dark">

                            <input type="hidden" name="id">

                            &nbsp;
                        <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>



    @include('backend.partials.scripts')
    @include('errors.toaster')
    @stack('script')

</body>

</html>
