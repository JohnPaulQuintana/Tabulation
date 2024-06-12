<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section' => 'Create Events'])
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to sports event section,
                        {{ auth()->user()->name }}
                    </span>
                </div>

                {{-- create events --}}
                <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2">


                    <div class="overflow-x-auto sm:rounded-lg">
                        <div>

                            <div
                                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900 text-xl">
                                <span>Create Sport's</span>

                            </div>

                            <form action="{{ route('admin.sports.store') }}" method="post" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                                @csrf
                                <div class="shadow py-2">
                                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2 px-2">

                                        <div class="shadow flex justify-center">
                                            <img class="w-24 h-24" src="{{ asset('images/experience-img.jpg') }}"
                                                alt="" srcset="">
                                        </div>
                                        <div class="shadow col-span-2 px-1">
                                            <label for="event_image">Sports Image</label>
                                            <input type="file" name="event_image" class="block w-full rounded-md"
                                                value="{{ old('event_image') }}">
                                            @error('event_image')
                                                <span class="text-red-500">Uploading Image is required.</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                                            <div class="px-1">
                                                <label for="event_name">Sports Name</label>
                                                <input type="text" name="event_name" class="block p-2 w-full rounded-md"
                                                    value="{{ old('event_name') }}">
                                                @error('event_name')
                                                    <span class="text-red-500">Name of sports is required.</span>
                                                @enderror
                                            </div>
                                            <div class="px-1">
                                                <label for="event_address">Sports Address</label>
                                                <input type="text" name="event_address" class="block p-2 w-full rounded-md"
                                                    value="{{ old('event_address') }}">
                                                @error('event_address')
                                                    <span class="text-red-500">Address of sports is required.</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="shadow col-span-3 px-1">
                                            <button type="submit"
                                                class="bg-blue-500 hover:cursor-pointer hover:bg-blue-700 p-1 w-full text-white rounded-sm">Save
                                                Sports</button>
                                        </div>
                                    </div>

                                </div>

                                <div class="shadow py-2">
                                    <div class="px-1">
                                        <label for="event_name">Sports Details</label>
                                        <textarea name="event_details" id="" cols="5" rows="3" class="w-full">{{ old('event_details') }}</textarea>
                                        @error('event_details')
                                            <span class="text-red-500">Details of Sports is required.</span>
                                        @enderror
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2">
                                        <div class="px-1">
                                            <label for="event_date">Sports Date</label>
                                            <input type="date" name="event_date" class="block p-2 w-full rounded-md"
                                                value="{{ old('event_date') }}">
                                            @error('event_date')
                                                <span class="text-red-500">Date of sports is required.</span>
                                            @enderror
                                        </div>
                                        <div class="px-1">
                                            <label for="event_time">Sports Time</label>
                                            <input type="time" name="event_time" class="block p-2 w-full rounded-md"
                                                value="{{ old('event_time') }}">
                                            @error('event_time')
                                                <span class="text-red-500">Time of sports is required.</span>
                                            @enderror
                                        </div>
                                        <div class="px-1">
                                            <label for="event_type">Sports Type</label>
                                            <select type="text" name="event_type" class="block p-2 w-full rounded-md hidden">
                                                <option value="sport" {{ old('event_type') == 'sport' ? 'selected' : '' }}>Sports Events</option>
                                                {{-- <option value="cultural" {{ old('event_type') == 'cultural' ? 'selected' : '' }}>Cultural Events</option> --}}
                                            </select>
                                            <input type="text" class="block p-2 w-full rounded-md">
                                            @error('event_type')
                                                <span class="text-red-500">Type of event is required.</span>
                                            @enderror
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

    @section("scripts")
        <script>
            $(document).ready(function(){
                
            })
        </script>
    @endsection
</x-app-layout>
