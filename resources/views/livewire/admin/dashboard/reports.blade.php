<div class="col-12">
    <div class="card">

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
            <h5 class="card-title">Reports <span>/{{$time}}</span></h5>
            <!-- Line Chart -->
            <div style="display: {{$day}};">
                <div id="reportsChart1" wire:ignore></div>
            </div>
            <div style="display: {{$month}};">
                <div id="reportsChart2" wire:ignore></div>
            </div>
            <div style="display: {{$year}};">
                <div id="reportsChart3" wire:ignore></div>
            </div>


            <script>
                document.addEventListener('livewire:load', function () {

                    new ApexCharts(document.querySelector("#reportsChart1"), {
                        series: [{
                            name: 'Sales',
                            data: [
                                @foreach ($sales1 as $t)
                                    {{ $t }},
                                @endforeach
                            ],
                        }, {
                            name: 'Revenue',
                            data: [
                                @foreach ($revenue1 as $t)
                                    {{ $t }},
                                @endforeach
                            ]
                        }, {
                            name: 'Customers',
                            data: [
                                @foreach ($customers1 as $t)
                                    {{ $t }},
                                @endforeach
                            ]
                        }],
                        chart: {
                            height: 350,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                        },
                        markers: {
                            size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                            type: "gradient",
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.3,
                                opacityTo: 0.4,
                                stops: [0, 90, 100]
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2
                        },
                        xaxis: {
                            categories: [
                                @foreach ($charttime1 as $t)
                                    "{{ $t }}",
                                @endforeach
                            ]
                        },

                    }).render();
                    new ApexCharts(document.querySelector("#reportsChart2"), {
                        series: [{
                            name: 'Sales',
                            data: [
                                @foreach ($sales2 as $t)
                                    {{ $t }},
                                @endforeach
                            ],
                        }, {
                            name: 'Revenue',
                            data: [
                                @foreach ($revenue2 as $t)
                                    {{ $t }},
                                @endforeach
                            ]
                        }, {
                            name: 'Customers',
                            data: [
                                @foreach ($customers2 as $t)
                                    {{ $t }},
                                @endforeach
                            ]
                        }],
                        chart: {
                            height: 350,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                        },
                        markers: {
                            size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                            type: "gradient",
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.3,
                                opacityTo: 0.4,
                                stops: [0, 90, 100]
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2
                        },
                        xaxis: {
                            categories: [
                                @foreach ($charttime2 as $t)
                                    "{{ $t }}",
                                @endforeach
                            ]
                        },

                    }).render();
                    new ApexCharts(document.querySelector("#reportsChart3"), {
                        series: [{
                            name: 'Sales',
                            data: [
                                @foreach ($sales3 as $t)
                                    {{ $t }},
                                @endforeach
                            ],
                        }, {
                            name: 'Revenue',
                            data: [
                                @foreach ($revenue3 as $t)
                                    {{ $t }},
                                @endforeach
                            ]
                        }, {
                            name: 'Customers',
                            data: [
                                @foreach ($customers3 as $t)
                                    {{ $t }},
                                @endforeach
                            ]
                        }],
                        chart: {
                            height: 350,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                        },
                        markers: {
                            size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                            type: "gradient",
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.3,
                                opacityTo: 0.4,
                                stops: [0, 90, 100]
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2
                        },
                        xaxis: {
                            categories: [
                                @foreach ($charttime3 as $t)
                                    "{{ $t }}",
                                @endforeach
                            ]
                        },

                    }).render();
                });
            </script>
            <!-- End Line Chart -->

        </div>

    </div>
</div>
