<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section'=>"Administrator"])
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to tabulation, {{ auth()->user()->name }}</span>
                </div>

                {{-- card --}}
                <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-2 mb-2">
                    {{-- {{ $events }} --}}
                    @for ($i=0;$i<4;$i++)
                        @include('partials.card', ['count' => $i+1])
                    @endfor
                </div>

                
            </div>
        </div>
    </div>
</x-app-layout>
