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
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to create event section,
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

                                <div class="rounded-md shadow-1 p-2">
                                    <div class="space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                                        
                                        <div class="flex justify-between items-center px-2">
                                            <span class="text-xl">Categories</span>
                                            {{-- <button type="button" id="addBtn" class="text-4xl text-blue-500 hover:text-blue-700">+</button> --}}
                                        </div>
                                        
                                        <div id="main-container" class="max-h-[400px] overflow-auto">

                                            <div class="shadow p-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                                                <div class="col-span-2 mb-2">
                                                    <input type="text" name="categories[]" class="rounded-md w-full"/> 
                                                </div>
                                                <div class="col-span-2 flex gap-2 justify-between items-center">
                                                    <span>Sub Categories</span>
                                                    <div>
                                                        <a href="#" class="subBtnAdd bg-blue-500 text-white rounded-sm p-1 hover:bg-blue-700">+add</a>
                                                        <a href="#" class="subBtnRemove bg-red-500 text-white rounded-sm p-1 hover:bg-red-700">remove</a>
                                                    </div>
                                                </div>
                                                <div class="p-1 col-span-2 sub_categories_container">
                                                    
                                                </div>
                                            </div>

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
                let subCategoryRender = ''

                
                $('.subBtnAdd').click(function(){
                    subCategoryRender = `
                        <div class="flex gap-1 mb-2 sub-category-item">
                            <input type="text" name="sub_categories[]" class="rounded-md flex-1" />
                            <select type="select" name="sub_percentage[]" class="rounded-md">
                                @for ($i=10;$i<=100;$i++)
                                    <option value="{{ $i }}">{{ $i }}%</option>
                                @endfor
                            </select>
                        </div>
                    `

                    $('.sub_categories_container').append(subCategoryRender)
                })

                $('.subBtnRemove').click(function(){
                    // alert('dwadwad')
                    $('.sub_categories_container .sub-category-item').last().remove();
                })
            })
        </script>
    @endsection
</x-app-layout>
