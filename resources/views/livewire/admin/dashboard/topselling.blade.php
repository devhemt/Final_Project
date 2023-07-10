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
            <h5 class="card-title">Top Selling <span>| {{$time}} || <a href="{{url('admin/topproduct/1')}}">detail</a></span></h5>

            <table class="table table-borderless">
                <thead>
                <tr>
                    <th scope="col">Preview</th>
                    <th scope="col">Product Code</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sold</th>
                </tr>
                </thead>
                <tbody>
                @foreach($topProducts as $product)
                    <tr>
                        <th scope="row"><a href="{{url('admin/product/'.$product->id)}}"><img src="{{asset('images/'.$product->demo_image)}}" alt=""></a></th>
                        <td>{{$product->product_code}}</td>
                        <td><a href="{{url('admin/product/'.$product->id)}}" class="text-primary fw-bold">{{$product->name}}</a></td>
                        <td>${{$product->price}}</td>
                        <td class="fw-bold">{{$product->total_sales}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>
</div>
