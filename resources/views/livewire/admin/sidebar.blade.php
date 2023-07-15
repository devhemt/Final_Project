<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link @if(!$DE) collapsed @endif" data-bs-target="#das-ele-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span wire:click="move">Dashboard</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="das-ele-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ url('admin/db/lowproduct/10') }}">
                    <i class="bi bi-circle"></i><span>Low products</span>
                </a>
            </li>
            <li>
                <a href="{{ url('admin/db/topproduct/1') }}">
                    <i class="bi bi-circle"></i><span>Top products</span>
                </a>
            </li>
            <li>
                <a href="{{ url('admin/db/revenue/1') }}">
                    <i class="bi bi-circle"></i><span>Revenue</span>
                </a>
            </li>
            <li>
                <a href="{{ url('admin/db/topcity/1') }}">
                    <i class="bi bi-circle"></i><span>Top city</span>
                </a>
            </li>
            <li>
                <a href="{{ url('admin/db/newcustomer/1') }}">
                    <i class="bi bi-circle"></i><span>Customer</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link  @if($currentUrl != '/admin/category/show') collapsed @endif " href="{{ url('admin/category/show') }}">
            <i class="bi bi-bookmarks"></i>
            <span>Category</span>
        </a>
        <a class="nav-link  @if($currentUrl != '/admin/supplier/show') collapsed @endif " href="{{ url('admin/supplier/show') }}">
            <i class="bi bi-handbag"></i>
            <span>Supplier</span>
        </a>
        <a class="nav-link  @if($currentUrl != '/admin/purchase/show') collapsed @endif " href="{{ url('admin/purchase/show') }}">
            <i class="bi bi-truck"></i>
            <span>Import Purchase</span>
        </a>
        <a class="nav-link  @if($currentUrl != '/admin/product') collapsed @endif " href="{{ url('admin/product') }}">
            <i class="bi bi-boxes"></i>
            <span>Product</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(!$order) collapsed @endif" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-card-heading"></i><span>Order</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{url('admin/customer_order')}}">
                    <i class="bi bi-circle"></i><span>Customer order</span>
                </a>
            </li>
            <li>
                <a href="{{url('admin/guest_order')}}">
                    <i class="bi bi-circle"></i><span>Guest order</span>
                </a>
            </li>
            <li>
                <a href="{{url('admin/offline/order')}}">
                    <i class="bi bi-circle"></i><span>Offline order</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a class="nav-link  @if($currentUrl != '/admin/comment') collapsed @endif " href="{{ url('admin/comment') }}">
            <i class="bi bi-chat-dots"></i>
            <span>Comment</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if(!$cus) collapsed @endif" data-bs-target="#cus-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-people"></i><span>Customer</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="cus-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ url('admin/create/customer') }}">
                    <i class="bi bi-circle"></i><span>Create customer</span>
                </a>
            </li>
            <li>
                <a href="{{ url('admin/showcustomer/1') }}">
                    <i class="bi bi-circle"></i><span>Show customer</span>
                </a>
            </li>
        </ul>
    </li>



    <li class="nav-item">
        <a class="nav-link @if(!$account) collapsed @endif" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person-rolodex"></i><span>Account</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{url('admin/profile/create')}}">
                    <i class="bi bi-circle"></i><span>Create account</span>
                </a>
            </li>
            <li>
                <a href="{{url('admin/profile/showall')}}">
                    <i class="bi bi-circle"></i><span>All account</span>
                </a>
            </li>
        </ul>
    </li><!-- End Tables Nav -->




    <li class="nav-heading">Pages</li>

    <li class="nav-item">
        <a class="nav-link @if($currentUrl != '/admin/profile') collapsed @endif " href="{{url('admin/profile')}}">
            <i class="bi bi-person"></i>
            <span>Profile</span>
        </a>
    </li><!-- End Profile Page Nav -->

</ul>
