<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section' => 'Judge'])
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to judge section,
                        {{ auth()->user()->name }}
                    </span>
                </div>

                {{-- create events --}}
                <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2">


                    <div class="overflow-x-auto sm:rounded-lg">
                        <div>
                            <div
                                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900 text-xl">
                                <span>Create Event's</span>

                            </div>
                            <form action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                                @csrf
                                <div class="shadow py-2">
                                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2 px-2">

                                        <div class="shadow flex justify-center">
                                            <img class="w-24 h-24" src="{{ asset('images/experience-img.jpg') }}"
                                                alt="" srcset="">
                                        </div>
                                        <div class="shadow col-span-2 px-1">
                                            <label for="event_image">Event Image</label>
                                            <input type="file" name="event_image" class="block w-full rounded-md"
                                                value="{{ old('event_image') }}">
                                            @error('event_image')
                                                <span class="text-red-500">Uploading Image is required.</span>
                                            @enderror
                                        </div>
                                        <div class="shadow col-span-3 px-1">
                                            <label for="event_name">Event Name</label>
                                            <input type="text" name="event_name" class="block p-2 w-full rounded-md"
                                                value="{{ old('event_name') }}">
                                            @error('event_name')
                                                <span class="text-red-500">Name of event is required.</span>
                                            @enderror
                                        </div>
                                        <div class="shadow col-span-3 px-1">
                                            <label for="event_name">Event Details</label>
                                            <textarea name="event_details" id="" cols="5" rows="3" class="w-full">{{ old('event_details') }}</textarea>
                                            @error('event_details')
                                                <span class="text-red-500">Details of event is required.</span>
                                            @enderror
                                        </div>
                                        <div class="shadow col-span-3 px-1">
                                            <label for="event_type">Event Type</label>
                                            <input type="text" name="event_type" class="block p-2 w-full rounded-md"
                                                value="{{ old('event_type') }}">
                                            @error('event_type')
                                                <span class="text-red-500">Type of event is required.</span>
                                            @enderror
                                        </div>
                                        <div class="shadow col-span-3 px-1">
                                            <button type="submit"
                                                class="bg-blue-500 hover:cursor-pointer hover:bg-blue-700 p-1 w-full text-white rounded-sm">Save
                                                Event</button>
                                        </div>
                                    </div>

                                </div>

                                <div class="rounded-md shadow p-2">
                                    <div class="space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                                        
                                        <div class="flex justify-between items-center">
                                            <span class="text-xl">Categories</span>
                                            <button type="button" id="addBtn" class="text-4xl text-blue-500 hover:text-blue-700">+</button>
                                        </div>
                                        
                                        <div class="shadow p-1 flex gap-1">
                                            <input type="text" name="category" class="rounded-md flex-1" />
                                            <button type="button" id="addBtn" class="bg-blue-500 rounded-md text-sm text-white hover:bg-blue-700">Percentage</button>
                                        </div>

                                        <div class="p-1 flex gap-1">
                                            <input type="text" name="category" class="rounded-md flex-1" />
                                            <select type="select" name="" id="" class="rounded-md">
                                                @for ($i=10;$i<=100;$i++)
                                                    <option value="{{ $i }}">{{ $i }}%</option>
                                                @endfor
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>