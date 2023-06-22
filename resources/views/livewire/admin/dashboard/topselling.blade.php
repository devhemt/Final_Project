<div class="col-12">
    <div class="card top-selling overflow-auto">

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

        <div class="card-body pb-0">
            <h5 class="card-title">Top Selling <span>| {{$time}}</span></h5>

            <table class="table table-borderless">
                <thead>
                <tr>
                    <th scope="col">Preview</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sold</th>
                    <th scope="col">Revenue</th>
                </tr>
                </thead>
                <tbody>
                @if($size >= 5)
                    @for($i = 0; $i < 5; $i++)
                        <tr>
                            <th scope="row"><a href="{{url('admin/product/'.$allprd[$i])}}"><img src="{{asset('images/'.$img[$allprd[$i]])}}" alt=""></a></th>
                            <td><a href="{{url('admin/product/'.$allprd[$i])}}" class="text-primary fw-bold">{{$name[$allprd[$i]]}}</a></td>
                            <td>${{$price[$allprd[$i]]}}</td>
                            <td class="fw-bold">{{$sold[$allprd[$i]]}}</td>
                            <td>${{$reveneu[$allprd[$i]]}}</td>
                        </tr>
                    @endfor
                @else
                    @foreach($allprd as $allprd)
                        <tr>
                            <th scope="row"><a href="{{url('admin/product/'.$allprd)}}"><img src="{{asset('images/'.$img[$allprd])}}" alt=""></a></th>
                            <td><a href="{{url('admin/product/'.$allprd)}}" class="text-primary fw-bold">{{$name[$allprd]}}</a></td>
                            <td>${{$price[$allprd]}}</td>
                            <td class="fw-bold">{{$sold[$allprd]}}</td>
                            <td>${{$reveneu[$allprd]}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

        </div>

    </div>
</div>
