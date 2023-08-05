<!DOCTYPE html>
<html lang="en">
@include('backend.partials.head')


<body themebg-pattern="theme1">

    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <div class="col-sm-5">
                    <!-- Authentication card start -->
                    @yield('content')

                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>


@include('backend.partials.scripts')
@include('errors.toaster')
</body>

</html>
