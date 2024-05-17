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
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to create event section,
                        {{ auth()->user()->name }}
                    </span>
                </div>

                {{-- create events --}}
                <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2">


                    <div class="overflow-x-auto grid grid-cols-2 sm:rounded-lg">
                        <div>
                            <div
                                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900 text-xl">
                                <span>Create Event's</span>

                            </div>

                            <div class="shadow py-2">
                                <form action="{{ route('admin.store') }}" method="post" class="flex flex-col flex-wrap gap-2" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="px-1 flex flex-col flex-auto">
                                        <div class="flex-1 w-full mb-2 flex gap-2 justify-center items-center">
                                            <img src="{{ asset('images/experience-img.jpg') }}" class="w-[500px] h-[250px] shadow rounded-md" alt="">
                                            <div class="w-full">
                                                <label for="event_image">Event Image</label>
                                                <input type="file" name="event_image" class="block p-2 w-full rounded-md" value="{{ old('event_image') }}">
                                                @error('event_image')
                                                    <span class="text-red-500">Uploading Image is required.</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="flex-1 w-full mb-2">
                                            <div class="w-full">
                                                <label for="event_name">Event Name</label>
                                                <input type="text" name="event_name" class="block p-2 w-full rounded-md" value="{{ old('event_name') }}">
                                                @error('event_name')
                                                    <span class="text-red-500">Name of event is required.</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="flex-1 w-full mb-2">
                                            <div class="w-full">
                                                <label for="event_name">Event Details</label>
                                                <textarea name="event_details" id="" cols="30" rows="5" class="w-full">{{ old('event_details') }}</textarea>
                                                @error('event_details')
                                                    <span class="text-red-500">Details of event is required.</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="flex-1 w-full">
                                            <div class="w-full">
                                                <label for="">Event Type</label>
                                                    <div class="flex items-center">
                                                        <div class="relative w-full">

                                                            <input type="text" name="event_type"
                                                                class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-s-lg border-r-gray-50 border-r-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                                                                placeholder="Enter a category or choose from all category..."
                                                                value="{{ old('event_type') }}" />

                                                                
                                                        </div>

                                                        <button id="dropdown-button" data-dropdown-toggle="dropdown"
                                                            class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-r-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
                                                            type="button">All categories <svg
                                                                class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 10 6">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="m1 1 4 4 4-4" />
                                                            </svg></button>
                                                        <div id="dropdown"
                                                            class="z-99999 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                                aria-labelledby="dropdown-button">
                                                                <li>
                                                                    <button type="button"
                                                                        class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pageant</button>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @error('event_type')
                                                        <span class="text-red-500">Type of event is required.</span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="flex-1 w-full mt-2">
                                            <div class="w-full">
                                                <input type="submit" class="w-full text-white bg-blue-500 hover:bg-blue-700 rounded-md p-2" value="Save Event">
                                            </div>
                                        </div>
                                        
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="rounded-md shadow p-2">
                            <div
                                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900 text-xl">
                                <div>
                                    <span>Categories</span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
