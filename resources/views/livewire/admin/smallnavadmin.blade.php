    <ul wire:poll.2000ms.visible="getTb" class="d-flex align-items-center">

    <li class="nav-item dropdown">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">
                @if($tb != 0)
                    1
                @else
                    0
                @endif
            </span>
        </a><!-- End Notification Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
                @if($tb != 0)
                You have 1 new notifications
                @else
                    You have 0 new notifications
                @endif
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>Có {{$tb}} đơn hàng mới</h4>
                    @if($tb != 0)
                        <p>{{$time}}</p>
                    @else
                        <p>You don't have new notifications</p>
                    @endif
                </div>
            </li>

{{--            <li>--}}
{{--                <hr class="dropdown-divider">--}}
{{--            </li>--}}

{{--            <li class="notification-item">--}}
{{--                <i class="bi bi-x-circle text-danger"></i>--}}
{{--                <div>--}}
{{--                    <h4>Đơn hàng giao lỗi</h4>--}}
{{--                    <p>Đơn hàng #ma0123 giao lỗi do không liên hệ đự với khách hàng</p>--}}
{{--                    <p>1 hr. ago</p>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--            <li>--}}
{{--                <hr class="dropdown-divider">--}}
{{--            </li>--}}

{{--            <li class="notification-item">--}}
{{--                <i class="bi bi-check-circle text-success"></i>--}}
{{--                <div>--}}
{{--                    <h4>Nhà cung cấp #supplier4 đã được thêm</h4>--}}
{{--                    <p>Nhà cung cấp #supplier4 đã được thêm</p>--}}
{{--                    <p>2 hrs. ago</p>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--            <li>--}}
{{--                <hr class="dropdown-divider">--}}
{{--            </li>--}}

{{--            <li class="notification-item">--}}
{{--                <i class="bi bi-info-circle text-primary"></i>--}}
{{--                <div>--}}
{{--                    <h4>Cập nhật thông tin</h4>--}}
{{--                    <p>Thông tin mới nhất về đợt nhập hàng 4 đã được cập nhật</p>--}}
{{--                    <p>4 hrs. ago</p>--}}
{{--                </div>--}}
{{--            </li>--}}


        </ul><!-- End Notification Dropdown Items -->

    </li><!-- End Notification Nav -->


    <li wire:ignore class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{asset('imagesadmin/images/'.$profile->image)}}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{$profile->name}}</span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
                <h6>{{$profile->name}}</h6>
                <span>{{$job}}</span>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>

            <li>
                <a class="dropdown-item d-flex align-items-center" href="{{url('admin/profile')}}">
                    <i class="bi bi-person"></i>
                    <span>My Profile</span>
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>

            <li>
                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                    <i class="bi bi-gear"></i>
                    <span>Account Settings</span>
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>

            <li>
                <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                    <i class="bi bi-question-circle"></i>
                    <span>Need Help?</span>
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>

            <li>
                <a class="dropdown-item d-flex align-items-center" href="{{url('admin/signout')}}">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
            </li>

        </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

</ul>
