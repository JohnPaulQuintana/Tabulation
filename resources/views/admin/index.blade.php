<x-app-layout>

    {{-- kapag wala to paki copy same sa pwesto kung nasaan --}}
    @section('links')
        <style>
            /* #welcome{
                color: red;
            } */
        </style>
    @endsection

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
                            {{-- <i class="fa-solid fa-calendar-check"></i> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[1em] h-[1em]" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zM329 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-95 95-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L329 305z"/></svg>
                        </div>
                        <div class="text-center text-md">
                            <span class="block font-bold text-3xl text-slate-800">0{{ count($events) }}</span>
                            <span class="text-sm">Total of Events</span>
                        </div>
                    </div>

                    <div class="shadow flex justify-center items-center gap-10 rounded-md p-2">
                        <div class="text-3xl text-slate-800">
                            {{-- <i class="fa-solid fa-users-rectangle"></i> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[35px] h-[35px]" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H544c53 0 96-43 96-96V96c0-53-43-96-96-96H96zM64 96c0-17.7 14.3-32 32-32H544c17.7 0 32 14.3 32 32V416c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V96zm159.8 80a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM96 309.3c0 14.7 11.9 26.7 26.7 26.7h56.1c8-34.1 32.8-61.7 65.2-73.6c-7.5-4.1-16.2-6.4-25.3-6.4H149.3C119.9 256 96 279.9 96 309.3zM461.2 336h56.1c14.7 0 26.7-11.9 26.7-26.7c0-29.5-23.9-53.3-53.3-53.3H421.3c-9.2 0-17.8 2.3-25.3 6.4c32.4 11.9 57.2 39.5 65.2 73.6zM372 289c-3.9-.7-7.9-1-12-1H280c-4.1 0-8.1 .3-12 1c-26 4.4-47.3 22.7-55.9 47c-2.7 7.5-4.1 15.6-4.1 24c0 13.3 10.7 24 24 24H408c13.3 0 24-10.7 24-24c0-8.4-1.4-16.5-4.1-24c-8.6-24.3-29.9-42.6-55.9-47zM512 176a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM320 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128z"/></svg>
                        </div>
                        <div class="text-center text-md">
                            <span class="block font-bold text-3xl text-slate-800">0{{ count($candidates) }}</span>
                            <span class="text-sm">Total of Candidates</span>
                        </div>
                    </div>

                    <div class="shadow flex justify-center items-center gap-10 rounded-md p-2">
                        <div class="text-3xl text-slate-800">
                            {{-- <i class="fa-solid fa-users-between-lines"></i> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[35px] h-[35px]" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0H616c13.3 0 24 10.7 24 24s-10.7 24-24 24H24C10.7 48 0 37.3 0 24zM0 488c0-13.3 10.7-24 24-24H616c13.3 0 24 10.7 24 24s-10.7 24-24 24H24c-13.3 0-24-10.7-24-24zM83.2 160a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM32 320c0-35.3 28.7-64 64-64h96c12.2 0 23.7 3.4 33.4 9.4c-37.2 15.1-65.6 47.2-75.8 86.6H64c-17.7 0-32-14.3-32-32zm461.6 32c-10.3-40.1-39.6-72.6-77.7-87.4c9.4-5.5 20.4-8.6 32.1-8.6h96c35.3 0 64 28.7 64 64c0 17.7-14.3 32-32 32H493.6zM391.2 290.4c32.1 7.4 58.1 30.9 68.9 61.6c3.5 10 5.5 20.8 5.5 32c0 17.7-14.3 32-32 32h-224c-17.7 0-32-14.3-32-32c0-11.2 1.9-22 5.5-32c10.5-29.7 35.3-52.8 66.1-60.9c7.8-2.1 16-3.1 24.5-3.1h96c7.4 0 14.7 .8 21.6 2.4zm44-130.4a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM321.6 96a80 80 0 1 1 0 160 80 80 0 1 1 0-160z"/></svg>
                        </div>
                        <div class="text-center text-md">
                            <span class="block font-bold text-3xl text-slate-800">0{{ count($judges) }}</span>
                            <span class="text-sm">Total of Judges</span>
                        </div>
                    </div>

                    <div class="shadow flex justify-center items-center gap-10 rounded-md p-2">
                        <div class="text-3xl text-slate-800">
                            {{-- <i class="fa-solid fa-layer-group"></i> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[35px] h-[35px]" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0H616c13.3 0 24 10.7 24 24s-10.7 24-24 24H24C10.7 48 0 37.3 0 24zM0 488c0-13.3 10.7-24 24-24H616c13.3 0 24 10.7 24 24s-10.7 24-24 24H24c-13.3 0-24-10.7-24-24zM83.2 160a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM32 320c0-35.3 28.7-64 64-64h96c12.2 0 23.7 3.4 33.4 9.4c-37.2 15.1-65.6 47.2-75.8 86.6H64c-17.7 0-32-14.3-32-32zm461.6 32c-10.3-40.1-39.6-72.6-77.7-87.4c9.4-5.5 20.4-8.6 32.1-8.6h96c35.3 0 64 28.7 64 64c0 17.7-14.3 32-32 32H493.6zM391.2 290.4c32.1 7.4 58.1 30.9 68.9 61.6c3.5 10 5.5 20.8 5.5 32c0 17.7-14.3 32-32 32h-224c-17.7 0-32-14.3-32-32c0-11.2 1.9-22 5.5-32c10.5-29.7 35.3-52.8 66.1-60.9c7.8-2.1 16-3.1 24.5-3.1h96c7.4 0 14.7 .8 21.6 2.4zm44-130.4a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM321.6 96a80 80 0 1 1 0 160 80 80 0 1 1 0-160z"/></svg>
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
