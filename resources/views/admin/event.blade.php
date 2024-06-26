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
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to event section,
                        {{ auth()->user()->name }}</span>
                </div>

                {{-- tables --}}
                <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2">


                    <div class="relative overflow-x-auto sm:rounded-lg p-2 bg-slate-100 h-[400px]">
                        <div
                            class="p-2 flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                            <span>Created Event's</span>
                            <div class="flex items-center gap-2">
                                <div>
                                    <a href="{{ route('admin.create') }}"
                                        class="bg-blue-500 p-2 rounded-sm text-white hover:bg-blue-700">+Event</a>
                                </div>
                                <div>
                                    <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                                        class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                        type="button">
                                        <span class="sr-only">Action button</span>
                                        Filters
                                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdownAction"
                                        class="z-[9999] hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownActionButton">
                                            <li data-event_id="0" class="hover:bg-slate-100 p-4 filterEventId">
                                                <a href="#" class="flex items-center px-2">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>
                                                    <i class="fa-solid fa-share-all text-xl"></i>
                                                    {{-- <img class="w-[25px]" src="{{ asset('storage').'/'.$event->image }}" alt="" srcset=""> --}}
                                                    <span>{{ __('Display all') }}</span>
                                                    
                                                </a>
                                            </li>
                                            @foreach ($events as $event)
                                                <li data-event_id="{{ $event->id }}" class="hover:bg-slate-100 p-4 filterEventId">
                                                    <a href="#" class="flex items-center px-2">
                                                        <div class="h-2.5 w-2.5 rounded-full {{ $event->status === 1 ? 'bg-green-500' : 'bg-red-500'}} me-2"></div>
                                                        <img class="w-[25px]" src="{{ asset('storage').'/'.$event->image }}" alt="" srcset="">
                                                        <span class="text-xs">{{ $event->name }}</span>
                                                        
                                                    </a>
                                                </li>
                                            @endforeach


                                        </ul>

                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <table id="eventTable"  class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    {{-- <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all-search" type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-slate-100 border-slate-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                        </div>
                                    </th> --}}
                                    <th scope="col" class="px-6 py-3">
                                        Event Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Candidates
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Judges
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Time
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{ $events }} --}}
                                @foreach ($events as $ev)
                                    <tr
                                        data-event_id="{{ $ev->id }}"
                                        class="bg-white border-b border-slate-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-100 dark:hover:bg-gray-600">
                                        {{-- <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td> --}}
                                        <th scope="row"
                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <img class="w-10 h-10 rounded-sm"
                                                src="{{ asset('storage').'/'.$ev->image }}" alt="Jese image">
                                            <div class="ps-3">
                                                <div class="text-sm font-semibold">{{ $ev->name }}</div>
                                                <div class="font-normal text-gray-500">Santiago City</div>
                                            </div>
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $ev->type }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <i class="fa-solid fa-list"></i>
                                            <a href="{{ route('admin.category', $ev->id) }}" class="font-bold text-blue-500 hover:cursor-pointer hover:text-blue-700">
                                                {{ count($ev->category) }}+
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <i class="fa-regular fa-user-group-simple"></i>
                                            <a href="{{ route('admin.candidate', $ev->id) }}" class="font-bold text-blue-500 hover:cursor-pointer hover:text-blue-700">
                                                {{ count($ev->candidates) }}+
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <i class="fa-regular fa-user-group-simple"></i>
                                            <a href="{{ route('admin.judge', $ev->id) }}" class="font-bold text-blue-500 hover:cursor-pointer hover:text-blue-700">
                                                {{ count($ev->judge) }}+
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @switch($ev->status)
                                                    @case(0)
                                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Offline
                                                        @break
                                                
                                                    @default
                                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                                                @endswitch
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span>{{ \Carbon\Carbon::parse($ev->date)->format('F d, Y') }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span>{{ \Carbon\Carbon::parse($ev->time)->format('h:i A') }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('admin.event.edit', $ev->id) }}"><i class="fa-solid fa-pen-to-square text-xl text-red-500 hover:text-red-700"></i></a>
                                            <a href="{{ route('admin.event.start', $ev->id) }}"><i class="fa-solid fa-circle-play text-xl text-blue-500 hover:text-blue-700"></i></a>
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

    @if (session('status'))
        @include('admin.popup.success')
    @endif

   
    @section('scripts')
        <script>
            $(document).ready(function(){
                $('.filterEventId').click(function(){
                    filterTable($(this).data('event_id'))
                })
                
                $('#modalCloseBtn').click(function(){
                    // alert('dwadwad')
                    $('#modalBackdrop').addClass('hidden')
                    $('#successModal').addClass('hidden')
                })
            })

            const filterTable = (filter) => {
                $('#eventTable tbody tr').each(function() {
                    const rowId = $(this).data('event_id');
                    if(filter === 0 || rowId === filter){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                })
            }
        </script>
    @endsection
</x-app-layout>
