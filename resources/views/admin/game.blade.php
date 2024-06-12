<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section' => 'Game Section'])
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 px-6 text-gray-900 dark:text-gray-100">
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to sport section, where the game started!
                        {{ auth()->user()->name }}</span>
                </div>
            </div>
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mt-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="flex justify-between items-center w-full p-2">
                    <p class="w-full">Selected Sports</p>
                    <div>


                        <button id="dropdownRadioBgHoverButton" data-dropdown-toggle="dropdownRadioBgHover"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">Status <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownRadioBgHover"
                            class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownRadioBgHoverButton">
                                <li>
                                    <form action="{{ route('admin.event.setStatus') }}" method="POST">
                                        <input type="number" name="event_id" value="{{ $sport->id }}"
                                            class="hidden">
                                        @csrf
                                        <div
                                            class="flex items-center p-2 rounded hover:bg-slate-100 hover:cursor-pointer">
                                            <input @if ($sport->status === 0) checked @endif id="default-radio-4"
                                                type="radio" value="0" name="set_status"
                                                onchange="this.form.submit()"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 hover:cursor-pointer">
                                            <label for="default-radio-4"
                                                class="w-full ms-2 text-sm font-medium text-red-500 rounded hover:cursor-pointer">Offline</label>
                                        </div>
                                        <div
                                            class="flex items-center p-2 rounded hover:bg-slate-100 hover:cursor-pointer">
                                            <input @if ($sport->status === 1) checked @endif id="default-radio-5"
                                                type="radio" value="1" name="set_status"
                                                onchange="this.form.submit()"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 hover:cursor-pointer">
                                            <label for="default-radio-5"
                                                class="w-full ms-2 text-sm font-medium text-blue-500 rounded dark:text-gray-300 hover:cursor-pointer">Online</label>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>



                    </div>
                </div>

                <div class="p-2 text-gray-900 grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-2">

                    <div class="shadow p-2 flex gap-1">
                        <img class="w-[100px]" src="{{ asset('storage') . '/' . $sport->image }}" alt="">
                        <div class="">
                            <h1 class="font-bold">{{ $sport->name }}</h1>
                            <p class="text-sm">{{ $sport->details }}</p>
                        </div>
                    </div>

                    <div class="shadow p-2 flex gap-1">
                        <i class="fa-solid fa-users-viewfinder text-5xl mr-2"></i>
                        <div class="text-center">
                            <h1 class="font-bold">Total of Judge's</h1>
                            <p class="text-md font-bold">{{ count($sport->judge) }}</p>
                        </div>
                    </div>

                    <div class="shadow p-2 flex gap-1">
                        <i class="fa-solid fa-people-group text-5xl mr-2"></i>
                        <div class="text-center">
                            <h1 class="font-bold">Total of Team's</h1>
                            <p class="text-md font-bold">{{ count($sport->teams) }}</p>
                        </div>
                    </div>

                    <div class="shadow p-2 flex gap-1">
                        <i class="fa-solid fa-layer-group text-5xl mr-2"></i>
                        <div class="text-center">
                            <h1 class="font-bold">Total of Categories</h1>
                            <p class="text-md font-bold">{{ count($sport->sportsCategories) }}</p>
                        </div>
                    </div>

                </div>

                <h1 class="px-2">Categories</h1>
                <div class="p-2 text-gray-900 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2">
                    @foreach ($sport->sportsCategories as $c)
                        <!-- Card -->
                        <a class="group flex flex-col shadow border border-slate-100 bg-slate-100 rounded-sm hover:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800" href="#">
                            <div class="p-4">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-1">
                                        <h3 class="flex items-center gap-2 group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-neutral-400 dark:text-neutral-200">
                                            <i class="fa-solid fa-circle text-[10px] text-red-500"></i>
                                            {{ $c->category }}
                                        </h3>
                                        <p class="text-sm bg-red-500 text-white px-4">
                                            Offline
                                        </p>
                                    </div>
                                    <div class="ps-3">
                                    <svg class="flex-shrink-0 size-5 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                    </div>
                                </div>
                                <div class="bg-slate-100 flex items-center mt-2 p-2">
                                    <div class="bg-blue-500 px-2 text-white flex-auto flex justify-between">
                                        <div class="flex flex-col">
                                            <span>Team 1</span>
                                        </div>
                                        <span class="text-white">V</span>
                                    </div>
                            
                                    <div class="bg-red-500 px-2 text-white flex-auto flex justify-between">
                                        <span class="text-white">S</span>
                                        <span>Team 2</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- End Card -->                        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
