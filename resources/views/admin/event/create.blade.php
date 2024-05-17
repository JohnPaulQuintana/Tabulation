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


                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <div
                            class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900 text-xl">
                            <span>Create Event's</span>

                        </div>
                        
                        <div class="shadow py-2">
                            <form action="#" method="post" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2">
                                @csrf
                                <div class="shadow">
                                    <img src="{{ asset('images/experience-img.jpg') }}" alt="">
                                </div>
                               <div>
                                    <div class="">
                                        <label for="event_name">Event Name</label>
                                        <input type="text" class="p-2 rounded-md">
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
