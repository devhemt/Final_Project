<div class="card">
    <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
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
        <h5 class="card-title">Top City <span>| {{$time}}</span></h5>

        <div id="city-card1" style="display: {{$day}};">
            <div id="trafficChart1" style="min-height: 400px;" class="echart" wire:ignore></div>
        </div>
        <div id="city-card2"  style="display: {{$month}};">
            <div id="trafficChart2" style="min-height: 400px;" class="echart" wire:ignore></div>
        </div>
        <div id="city-card3"  style="display: {{$year}};">
            <div id="trafficChart3" style="min-height: 400px;" class="echart" wire:ignore></div>
        </div>

        <script>
            document.addEventListener('livewire:load', function () {
                echarts.init(document.querySelector("#trafficChart1")).setOption({
                    tooltip: {
                        trigger: 'item'
                    },
                    legend: {
                        top: '5%',
                        left: 'center'
                    },
                    series: [{
                        name: 'Access From',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '18',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        data: [
                            @foreach($data1 as $d)
                                {
                                    value: {{$d[1]}},
                                    name: '{{$d[0]}}'
                                },
                            @endforeach
                        ]
                    }]
                });
                echarts.init(document.querySelector("#trafficChart2")).setOption({
                    tooltip: {
                        trigger: 'item'
                    },
                    legend: {
                        top: '5%',
                        left: 'center'
                    },
                    series: [{
                        name: 'Access From',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '18',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        data: [
                                @foreach($data2 as $d)
                                    {
                                        value: {{$d[1]}},
                                        name: '{{$d[0]}}'
                                    },
                                @endforeach
                        ]
                    }]
                });
                echarts.init(document.querySelector("#trafficChart3")).setOption({
                    tooltip: {
                        trigger: 'item'
                    },
                    legend: {
                        top: '5%',
                        left: 'center'
                    },
                    series: [{
                        name: 'Access From',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '18',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        data: [
                                @foreach($data3 as $d)
                                {
                                    value: {{$d[1]}},
                                    name: '{{$d[0]}}'
                                },
                                @endforeach
                        ]
                    }]
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    var divElement = document.getElementById('city-card2');
                    divElement.style.display = 'none';
                    var divElement1 = document.getElementById('city-card3');
                    divElement1.style.display = 'none';
                }, 500);
            });
        </script>

    </div>
</div>
