<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section' => 'Event Started'])
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to event section, where the event started!
                        {{ auth()->user()->name }}</span>
                </div>

                <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2">
                    {{-- event name --}}
                    <div class="relative overflow-x-auto sm:rounded-lg p-2 bg-slate-100 mb-2">
                        <div class="p-2 flex flex-col gap-2 items-center justify-between flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                            <div class="flex justify-between items-center w-full">
                                <p class="w-full">Active Event</p>
                                <div>
                                    
                                    
                                    <button id="dropdownRadioBgHoverButton" data-dropdown-toggle="dropdownRadioBgHover" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Status <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                        </svg>
                                        </button>
                                        
                                        <!-- Dropdown menu -->
                                        <div id="dropdownRadioBgHover" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRadioBgHoverButton">
                                                <li>
                                                    <form action="{{ route('admin.event.setStatus') }}" method="POST">
                                                        <input type="number" name="event_id" value="{{ $activeEvents->id }}" class="hidden">
                                                        @csrf
                                                        <div class="flex items-center p-2 rounded hover:bg-slate-100 hover:cursor-pointer">
                                                            <input @if($activeEvents->status === 0) checked @endif id="default-radio-4" type="radio" value="0" name="set_status" onchange="this.form.submit()" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 hover:cursor-pointer">
                                                            <label for="default-radio-4" class="w-full ms-2 text-sm font-medium text-red-500 rounded hover:cursor-pointer">Offline</label>
                                                        </div>
                                                        <div class="flex items-center p-2 rounded hover:bg-slate-100 hover:cursor-pointer">
                                                            <input @if($activeEvents->status === 1) checked @endif id="default-radio-5" type="radio" value="1" name="set_status" onchange="this.form.submit()" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 hover:cursor-pointer">
                                                            <label for="default-radio-5" class="w-full ms-2 text-sm font-medium text-blue-500 rounded dark:text-gray-300 hover:cursor-pointer">Online</label>
                                                        </div>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
    
    
    
                                </div>
                            </div>
                            <div class="w-full grid grid-cols-4 gap-2">

                                <div>
                                    <div class="shadow p-2 flex items-center mb-2">
                                        <img class="w-16 h-16" src="{{ asset('storage').'/'.$activeEvents->image }}" alt="">
                                        <div class="text-center">
                                            <span class="block font-semibold">{{ $activeEvents->name }}</span>
                                            <span>{{ $activeEvents->address }}</span>
                                        </div>
                                    </div>
    
                                    <div class="shadow p-2 flex items-center mb-2">
                                        <i class="fa-solid fa-users-viewfinder text-5xl mr-2"></i>
                                        <div class="text-center">
                                            <span class="block font-semibold">{{ __('Candidates') }}</span>
                                            <span>Total: <span class="font-bold">{{ count($activeEvents->candidates) }}</span></span>
                                        </div>
                                    </div>
    
                                    <div class="shadow p-2 flex items-center mb-2">
                                        <i class="fa-solid fa-users-between-lines text-5xl mr-2"></i>
                                        <div class="text-center">
                                            <span class="block font-semibold">{{ __('Judge') }}</span>
                                            <span>Total: <span class="font-bold">{{ count($activeEvents->judge) }}</span></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-slate-50 col-span-3 p-2">
                                    <h1 class="uppercase font-semibold">Candidates Leading in Votes</h1>
                                    <div>
                                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 bg-white">
                                            <thead
                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="p-4">
                                                        {{-- <div class="flex items-center">
                                                            <i class="fa-solid fa-circle-check text-xl text-"></i>
                                                        </div> --}}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Name
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Category
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Total Votes (%)
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Percentage
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    // Extract candidates and sort by vote_results['total'] in descending order
                                                    $sortedCandidates = $activeEvents->candidates->sortByDesc(function($candidate) {
                                                        return $candidate->vote_results['total'];
                                                    });
                                                @endphp

                                                @foreach ($sortedCandidates as $candidate)
                                                    <tr class="bg-white border-b border-slate-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-100 dark:hover:bg-gray-600">
                                                        <td class="w-4 p-4">
                                                            <div class="flex items-center">
                                                                <i class="fa-solid fa-square-check text-2xl text-green-500"></i>
                                                            </div>
                                                        </td>
                                                        <td scope="row"
                                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                            <img class="w-10 h-10 rounded-sm"
                                                                src="{{ asset('storage').'/'.$candidate->profile }}" alt="Jese image">
                                                            <div class="ps-3">
                                                                <div class="text-base font-semibold">{{ $candidate->name }}</div>
                                                                <div class="font-normal text-gray-500">Santiago City</div>
                                                            </div>
                                                        </td>
                                                        <td class="p-4">
                                                            <div class="flex items-center">
                                                                {{ $activeCategory->category_name }}
                                                            </div>
                                                        </td>
                                                        <td class="p-4">
                                                            <div class="flex items-center">
                                                                {{ $candidate->vote_results['total'] }}%
                                                            </div>
                                                        </td>
                                                        <td class="p-4">
                                                            <div class="flex items-center">
                                                                {{ __('100%') }}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- category set --}}
                    <div class="relative overflow-x-auto sm:rounded-lg p-2 bg-slate-100">
                        <div class="p-2 flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                            <span class="w-full">Event Category</span>
                            <div class="flex gap-4">
                                {{-- {{ $activeEvents->category }} --}}
                                @foreach ($activeEvents->category as $category)
                                    <div class="flex-shrink-0 w-64 shadow p-4 items-center">
                                        <h1 class="font-semibold mb-2">
                                            @if ($category->status)
                                                <i class="fa-solid fa-circle text-xs text-green-500"></i>
                                            @else
                                            <i class="fa-solid fa-circle text-xs text-red-500"></i>
                                            @endif
                                             {{ $category->category_name }}
                                        </h1>
                                        @foreach ($category->subCategory as $sub)
                                            <div class="flex justify-between items-center gap-2 bg-slate-100 p-1 capitalize">
                                                <span>{{ $sub->sub_category }}</span>
                                                <span>{{ $sub->percentage }}%</span>
                                            </div>
                                        @endforeach

                                        <div class="py-2 mx-auto flex items-center">
                                            @switch($category->status)
                                                @case(false)
                                                    <a href="{{ route('admin.event.start.voting', $category->id) }}" class="rounded-md bg-blue-500 w-full text-white text-center hover:bg-blue-700 p-1">activate</a>
                                                    @break
                                                @case(true)
                                                    <a href="#" class="rounded-md bg-slate-100 w-full text-yellow-400 text-center p-1">in-progress...</a>
                                                    @break
                                                {{-- @case("3")
                                                    <a href="#" class="rounded-md bg-slate-100 w-full text-yellow-400 text-center hover:bg-blue-700 p-1">in-progress...</a>
                                                    @break --}}
                                            
                                                @default
                                                    
                                            @endswitch
                                            
                                        </div>
                                    </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('status'))
            @include('admin.popup.status', ['status'=>session('status')])
        @endif

        @section('scripts')
            <script>
                $(document).ready(function(){
                    $('#statusCloseBtn').click(function(){
                        $('#statusBackdrop').addClass('hidden')
                        $('#statusModal').addClass('hidden')
                    })
                })
            </script>
        @endsection
</x-app-layout>