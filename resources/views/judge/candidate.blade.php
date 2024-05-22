
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section'=>auth()->user()->name])
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 relative">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2">

                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-xl">Candidates for <span class="bg-slate-700 p-1 text-white">{{ $activeEvent->name }}</span></h1>
                    <span class="text-orange-500"><i class="fa-solid fa-calendar-clock"></i> On-going</span>
                </div>
                <div class="flex gap-4 shadow px-2">
                    @include('judge.indicator.steps', ['categories'=>$activeEvent->category])
                </div>
                <div class="bg-white rounded-md p-2 shadow-2 mt-4 flex flex-wrap gap-4">
                    
                    @foreach ($activeEvent->candidates as $key => $candidate)
                        <div class="shadow group hover:cursor-pointer">
                            <div class="relative overflow-hidden">
                                <img class="w-30 h-30 transform transition-transform duration-300 ease-in-out group-hover:scale-110" 
                                    src="{{ asset('storage').'/'.$candidate->profile }}" alt="">
                                <span class="absolute top-1 left-1 bg-red-500 p-1 rounded-xl text-white font-bold text-sm">
                                    
                                    @if ($key < 10)
                                        0{{ $key+1 }}
                                    @else
                                        {{ $key }}
                                    @endif
                                </span>
                                <button class="absolute w-fit h-fit tracking-wide top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-red-500 px-4 py-2 rounded-xl text-white font-bold text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">
                                    Vote
                                </button>
                            </div>
                            <div class="flex flex-col max-w-30 text-center text-sm">
                                <span class="font-bold">{{ $candidate->name }}</span>
                                <span>Age: <b>{{ $candidate->age }}</b></span>
                            </div>
                        </div>
                    
                    @endforeach
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


