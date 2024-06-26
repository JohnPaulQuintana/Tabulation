<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section' => 'Administrator'])
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to tabulation, {{ auth()->user()->name }}</span>
                </div>

                {{-- card --}}
                <div
                    class="max-w-12xl mx-auto sm:px-6 lg:px-2 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-2 mb-2">
                    {{-- {{ $events }} --}}
                    <div class="shadow flex justify-center items-center gap-10 rounded-md p-2">
                        <div class="text-3xl text-slate-800">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <div class="text-center text-md">
                            <span class="block font-bold text-3xl text-slate-800">0{{ count($events) }}</span>
                            <span class="text-sm">Total of Events</span>
                        </div>
                    </div>

                    <div class="shadow flex justify-center items-center gap-10 rounded-md p-2">
                        <div class="text-3xl text-slate-800">
                            <i class="fa-solid fa-users-rectangle"></i>
                        </div>
                        <div class="text-center text-md">
                            <span class="block font-bold text-3xl text-slate-800">0{{ count($candidates) }}</span>
                            <span class="text-sm">Total of Candidates</span>
                        </div>
                    </div>

                    <div class="shadow flex justify-center items-center gap-10 rounded-md p-2">
                        <div class="text-3xl text-slate-800">
                            <i class="fa-solid fa-users-between-lines"></i>
                        </div>
                        <div class="text-center text-md">
                            <span class="block font-bold text-3xl text-slate-800">0{{ count($judges) }}</span>
                            <span class="text-sm">Total of Judges</span>
                        </div>
                    </div>

                    <div class="shadow flex justify-center items-center gap-10 rounded-md p-2">
                        <div class="text-3xl text-slate-800">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <div class="text-center text-md">
                            <span class="block font-bold text-3xl text-slate-800">0{{ count($categories) }}</span>
                            <span class="text-sm">Total of Categories</span>
                        </div>
                    </div>

                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span class="text-sm md:text-xl lg:text-xl">Statistics of tabulation</span>
                </div>

                <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2 grid gap-2">
                    <div>
                        @include('admin.chart.chart')
                    </div>
                    <div>
                        @include('admin.chart.pie')
                    </div>
                    
                </div>

            </div>
        </div>
    </div>

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            $(document).ready(function() {
                let pieChartDatas = @json($events);
                let events = @json($activeEvents);
                let categories = @json($categoriesChart);
                let categoriesLoss = @json($categoriesChartLoss);
                let Teams = @json($teams);
                let Type = @json($type);
               
                // console.log(categoriesLoss)
                $('#title').text(events.name)
                $('#sub-title').text(events.details)
                // bar chart
                const options = {
                    colors: ["#1A56DB", "#FDBA8C"],
                    series: Type === 'sport' ? [
                        {
                            name: Type === 'sport' ? 'Team Win' : "Overall Percentage",
                            color: "#1A56DB",
                            data: categories,
                        },
                        {
                            name: Type === 'sport' ? 'Team Loss' : "Overall Percentage",
                            color: "#FF0000",
                            data: categoriesLoss,
                        },
                        
                    ] : [
                        {
                            name: Type === 'sport' ? 'Team Win' : "Overall Percentage",
                            color: "#1A56DB",
                            data: categories,
                        },
                    ],
                    chart: {
                        type: "bar",
                        height: "320px",
                        fontFamily: "Inter, sans-serif",
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: "50%",
                            borderRadiusApplication: "end",
                            borderRadius: 2,
                        },
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        style: {
                            fontFamily: "Inter, sans-serif",
                        },
                    },
                    states: {
                        hover: {
                            filter: {
                                type: "darken",
                                value: 1,
                            },
                        },
                    },
                    stroke: {
                        show: true,
                        width: 0,
                        colors: ["transparent"],
                    },
                    grid: {
                        show: true,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: -14
                        },
                    },
                    dataLabels: {
                        enabled: true,
                    },
                    legend: {
                        show: true,
                    },
                    xaxis: {
                        title: {
                            text: 'Participants on the Event'
                        },
                        floating: false,
                        labels: {
                            show: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                            }
                        },
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                    },
                    yaxis: {
                        title: {
                            text: Type === 'sport' ? 'Team Winning Records' : 'Overall Percentage'
                        },
                        show: true,
                        min: Type === 'sport' ? 0 : 10,
                        max: Type === 'sport' ? 10 : 100,
                        labels: {
                            formatter: function (value) {
                                return value
                            }
                        }
                    },
                    fill: {
                        opacity: 1,
                    },
                }

                if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.getElementById("column-chart"), options);
                    chart.render();
                }

                //pie chart

                const getChartOptions = () => {
                    let pieLabel = []
                    let candidatesCount = []
                    pieChartDatas.forEach(e => {
                        pieLabel.push(e.name)
                        candidatesCount.push((e.candidates.length === 0 ? 1 : e.candidates.length))
                    });
                    console.log(candidatesCount)
                    return {
                        series: candidatesCount,
                        colors: ["#1C64F2", "#16BDCA", "#9061F9"],
                        chart: {
                            height: 420,
                            width: "100%",
                            type: "pie",
                        },
                        stroke: {
                            colors: ["white"],
                            lineCap: "",
                        },
                        plotOptions: {
                            pie: {
                                labels: {
                                    show: true,
                                },
                                size: "100",
                                dataLabels: {
                                    offset: -25
                                }
                            },
                        },
                        labels: pieLabel,
                        dataLabels: {
                            enabled: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                                
                            },
                        },
                        legend: {
                            position: "bottom",
                            fontFamily: "Inter, sans-serif",
                        },
                        yaxis: {
                            labels: {
                                formatter: function(value) {
                                    return value + " Candidates"
                                },
                            },
                        },
                        xaxis: {
                            labels: {
                                formatter: function(value) {
                                    return value + "Candidates"
                                },
                            },
                            axisTicks: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                        },
                    }
                }

                if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
                    chart.render();
                }


            })
        </script>
    @endsection
</x-app-layout>
