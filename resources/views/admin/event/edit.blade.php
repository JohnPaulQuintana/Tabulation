<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section' => 'Edit Events'])
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to edit event section,
                        {{ auth()->user()->name }}
                    </span>
                </div>

                {{-- {{ $edit }} --}}
                {{-- create events --}}
                <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2">


                    <div class="overflow-x-auto sm:rounded-lg">
                        <div>

                            <div
                                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900 text-xl">
                                <span>Edit Event's</span>

                            </div>

                            <form action="{{ route('admin.event.update') }}" method="post" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                                @csrf
                                <input type="number" name="event_id" value="{{ $edit->id }}" class="hidden">
                                <div class="shadow py-2">
                                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2 px-2">

                                        <div class="shadow flex justify-center">
                                            <img class="w-24 h-24" src="{{ asset('storage').'/'.$edit->image }}"
                                                alt="" srcset="">
                                        </div>
                                        <div class="shadow col-span-2 px-1">
                                            <label for="event_image">Event Image</label>
                                            <input type="file" name="event_image" class="block w-full rounded-md"
                                                value="{{ old('event_image') }}">
                                        </div>
                                        <div class="col-span-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                                            <div class="px-1">
                                                <label for="event_name">Event Name</label>
                                                <input type="text" name="event_name" class="block p-2 w-full rounded-md"
                                                    value="{{ $edit->name }}">
                                                @error('event_name')
                                                    <span class="text-red-500">Name of event is required.</span>
                                                @enderror
                                            </div>
                                            <div class="px-1">
                                                <label for="event_address">Event Address</label>
                                                <input type="text" name="event_address" class="block p-2 w-full rounded-md"
                                                    value="{{ $edit->address  }}">
                                                @error('event_address')
                                                    <span class="text-red-500">Address of event is required.</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="shadow col-span-3 flex gap-2 px-1">
                                            <a href="{{ route('admin.event') }}" class="bg-red-500 text-center text-white p-1 w-full hover:bg-red-700">Cancel</a>
                                            <button type="submit"
                                                class="bg-blue-500 hover:cursor-pointer hover:bg-blue-700 p-1 w-full text-white rounded-sm">Update
                                                Event</button>
                                        </div>
                                    </div>

                                </div>

                                <div class="shadow py-2">
                                    <div class="px-1">
                                        <label for="event_name">Event Details</label>
                                        <textarea name="event_details" id="" cols="5" rows="3" class="w-full">{{ $edit->details  }}</textarea>
                                        @error('event_details')
                                            <span class="text-red-500">Details of event is required.</span>
                                        @enderror
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2">
                                        <div class="px-1">
                                            <label for="event_date">Event Date</label>
                                            <input type="date" name="event_date" class="block p-2 w-full rounded-md"
                                                value="{{ $edit->date  }}">
                                            @error('event_date')
                                                <span class="text-red-500">Date of event is required.</span>
                                            @enderror
                                        </div>
                                        <div class="px-1">
                                            <label for="event_time">Event Time</label>
                                            <input type="time" name="event_time" class="block p-2 w-full rounded-md"
                                                value="{{ $edit->time  }}">
                                            @error('event_time')
                                                <span class="text-red-500">Time of event is required.</span>
                                            @enderror
                                        </div>
                                        <div class="px-1">
                                            <label for="event_type">Event Type</label>
                                            <input type="text" name="event_type" class="block p-2 w-full rounded-md"
                                                value="{{ $edit->type  }}">
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
