<ul class="d-flex align-items-center">

    <li class="nav-item dropdown">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
        </a><!-- End Notification Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
                You have 4 new notifications
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>Lorem Ipsum</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>30 min. ago</p>
                </div>
            </li>

            <li>
                <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
                <i class="bi bi-x-circle text-danger"></i>
                <div>
                    <h4>Atque rerum nesciunt</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>1 hr. ago</p>
                </div>
            </li>

            <li>
                <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
                <i class="bi bi-check-circle text-success"></i>
                <div>
                    <h4>Sit rerum fuga</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>2 hrs. ago</p>
                </div>
            </li>

            <li>
                <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
                <i class="bi bi-info-circle text-primary"></i>
                <div>
                    <h4>Dicta reprehenderit</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>4 hrs. ago</p>
                </div>
            </li>


        </ul><!-- End Notification Dropdown Items -->

    </li><!-- End Notification Nav -->


    <li class="nav-item dropdown pe-3">

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
