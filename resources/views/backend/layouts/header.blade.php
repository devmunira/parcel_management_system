 <!-- [ Header ] start -->
 <nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a href="">
                <h6 class="text-light">{{ __('DEMAND ZONE') }}</h6>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu icon-toggle-right"></i>
            </a>
            <a class="mobile-options waves-effect waves-light">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-prepend search-close">
                            <i class="feather icon-x input-group-text"></i>
                        </span>
                            <input type="text" class="form-control" placeholder="Enter Keyword">
                            <span class="input-group-append search-btn">
                            <i class="feather icon-search input-group-text"></i>
                        </span>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                    <i class="full-screen feather icon-maximize"></i>
                </a>
                </li>


            </ul>
            <ul class="nav-right">
                <li>
                    <a href="{{ route('admin.order.create') }}"  class="order-btn shadow-sm"> New Order
                </a>
                </li>
                <li class="user-profile header-notification">

                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ Auth::guard('admin')->user()->profile ? asset('/backend/uploads/admin/'.Auth::guard('admin')->user()->profile) :  asset('uploads/placeholder/image_preview.jpg') }}" class="img-radius" alt="User-Profile-Image">
                            <span>{{ auth('admin')->user()->name }}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <a href="{{ route('admin.password.change') }}">
                                <i class="feather icon-settings"></i> Password Settings

                            </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.profile') }}">
                                <i class="feather icon-user"></i> Profile Settings

                            </a>
                            </li>


                            <li>
                                <a href="#" id="admin_logout_btn">
                                <i class="feather icon-log-out"></i> Logout

                            </a>

                            <form id="admin_logout_form" method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                            </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

@push('script')

    <script>
        "use-strict";
        (function($){
            $(document).ready(function(){
                // admin form logout
                logoutFormSubmit('#admin_logout_btn' , '#admin_logout_form');
            });
        })(jQuery)

    </script>

@endpush
