 <!-- [ navigation menu ] start -->
 <nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigation-label">Navigation</div>
            <ul class="pcoded-item pcoded-left-item">
                @if (Auth::guard('admin')->user()->dashboard)

                <li class="{{ activeMenu('admin.home') }}">
                    <a href="{{ route('admin.home') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                        </span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                @endif

                @if (Auth::guard('admin')->user()->orders)
                <li class="pcoded-hasmenu {{ activeMenuMain('admin.order.*') }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fab fa-accusoft"></i>
                        </span>
                        <span class="pcoded-mtext">Order
                        </span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ activeMenuMain('admin.order.index') }}">
                            <a href="{{ route('admin.order.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">All Order</span>
                            </a>
                        </li>
                        <li class="{{ activeMenuMain('admin.order.trash.index') }}">
                            <a href="{{ route('admin.order.trash.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Trash Order</span>
                            </a>
                        </li>
                        <li class="{{ activeMenuMain('admin.order.create') }}">
                            <a href="{{ route('admin.order.create') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Add New Order</span>
                            </a>
                        </li>

                    </ul>
                </li>
                @endif

                @if (Auth::guard('admin')->user()->report)
                <li class="pcoded-hasmenu {{ activeMenuMain('admin.report.index') }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fab fa-accusoft"></i>
                        </span>
                        <span class="pcoded-mtext">Report
                        </span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ activeMenuMain('admin.report.index') }}">
                            <a href="{{ route('admin.report.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Reports</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Auth::guard('admin')->user()->deliverymen)
                <li class="{{ activeMenu('admin.delivery.man.index') }}">
                    <a href="{{ route('admin.delivery.man.index') }}" class=" waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fas fa-users"></i>
                        </span>
                        <span class="pcoded-mtext">Delivery Man</span>
                    </a>
                </li>
                @endif

                @if (Auth::guard('admin')->user()->deliverymethod)
                <li class="{{ activeMenu('admin.delivery.method.index') }}">
                    <a href="{{ route('admin.delivery.method.index') }}" class=" waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fab fa-accessible-icon"></i>
                        </span>
                        <span class="pcoded-mtext">Delivery Method</span>
                    </a>
                </li>
                @endif


                @if (Auth::guard('admin')->user()->user)

                <li class="{{ activeMenu('admin.role.index') }}">
                    <a href="{{ route('admin.role.index') }}" class=" waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fas fa-user-plus"></i>
                        </span>
                        <span class="pcoded-mtext">User Managment</span>
                    </a>
                </li>


                @endif



                @if (Auth::guard('admin')->user()->database_backup)
                <li class="">
                    <a href="{{ route('admin.our_backup_database') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fas fa-database"></i>
                                                </span>
                        <span class="pcoded-mtext">Database Backup</span>
                    </a>
                </li>
                @endif

                @if (Auth::guard('admin')->user()->cache)
                <li class="">
                    <a href="{{ route('admin.cache') }}" class=" waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="pcoded-mtext">Cache Clear</span>
                    </a>
                </li>
                @endif

            </ul>




        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
