<div class="col-xxl-4 col-xl-12">
    <div class="card info-card revenue-card">

        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-chevron-down ms-auto"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                </li>

                <li><a wire:click="today" class="dropdown-item">Today</a></li>
                <li><a wire:click="thismonth" class="dropdown-item">This Month</a></li>
                <li><a wire:click="thisyear" class="dropdown-item">This Year</a></li>
            </ul>
        </div>

        <div class="card-body">
            <h5 class="card-title">Revenue <span>| {{$time}}</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                    <h6>${{$amount}}</h6>
                    <span class="{{$class}} small pt-1 fw-bold">{{$percent}}%</span> <span class="text-muted small pt-2 ps-1">{{$status}}</span>

                </div>
            </div>
        </div>

    </div>
</div>
