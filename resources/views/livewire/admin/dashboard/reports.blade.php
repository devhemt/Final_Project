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
            <h5 class="card-title">Products sold <span>/{{$time}}</span></h5>
            <!-- Line Chart -->
            <div style="display: {{$day}};">
                <div id="lineChart1" wire:ignore></div>
            </div>
            <div style="display: {{$month}};">
                <div id="lineChart2" wire:ignore></div>
            </div>
            <div style="display: {{$year}};">
                <div id="lineChart3" wire:ignore></div>
            </div>


            <script>
                document.addEventListener('livewire:load', function () {
                    new ApexCharts(document.querySelector("#lineChart1"), {
                        series: [{
                            name: "Products sold",
                            data: [
                                @foreach ($data1 as $d)
                                    {{ $d }},
                                @endforeach
                            ]
                        }],
                        chart: {
                            height: 350,
                            type: 'line',
                            zoom: {
                                enabled: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'straight'
                        },
                        grid: {
                            row: {
                                colors: ['#f3f3f3', 'transparent'],
                                opacity: 0.5
                            },
                        },
                        xaxis: {
                            categories: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'],
                            title: {
                                text: 'Hour'
                            },
                        },
                        yaxis: {
                            title: {
                                text: 'Amount'
                            },
                        },
                    }).render();
                    new ApexCharts(document.querySelector("#lineChart2"), {
                        series: [{
                            name: "Products sold",
                            data: [
                                @foreach ($data2 as $d)
                                    {{ $d }},
                                @endforeach
                            ]
                        }],
                        chart: {
                            height: 350,
                            type: 'line',
                            zoom: {
                                enabled: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'straight'
                        },
                        grid: {
                            row: {
                                colors: ['#f3f3f3', 'transparent'],
                                opacity: 0.5
                            },
                        },
                        xaxis: {
                            categories: [
                                @for ($i = 1; $i < 32; $i++)
                                    {{ $i }},
                                @endfor
                            ],
                            title: {
                                text: 'Day'
                            },
                        },
                        yaxis: {
                            title: {
                                text: 'Amount'
                            },
                        },
                    }).render();
                    new ApexCharts(document.querySelector("#lineChart3"), {
                        series: [{
                            name: "Products sold",
                            data: [
                                @foreach ($data3 as $d)
                                    {{ $d }},
                                @endforeach
                            ]
                        }],
                        chart: {
                            height: 350,
                            type: 'line',
                            zoom: {
                                enabled: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'straight'
                        },
                        grid: {
                            row: {
                                colors: ['#f3f3f3', 'transparent'],
                                opacity: 0.5
                            },
                        },
                        xaxis: {
                            categories: [
                                @for ($i = 1; $i < 13; $i++)
                                    {{ $i }},
                                @endfor
                            ],
                            title: {
                                text: 'Month'
                            },
                        },
                        yaxis: {
                            title: {
                                text: 'Amount'
                            },
                        },
                    }).render();

                });
            </script>
            <!-- End Line Chart -->

        </div>

    </div>
</div>
