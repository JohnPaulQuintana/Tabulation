
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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <section class="bg-white dark:bg-gray-900 bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg')] dark:bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern-dark.svg')]">
                    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 z-10 relative">
                        <span class="inline-flex justify-between items-center py-1 px-1 pe-4 mb-7">
                            <span class="text-4xl font-extrabold tracking-tight leading-none text-gray-900 px-4 py-1.5 me-3 uppercase">Welcome to AMA Tabulation System</span> 
                            
                        </span>
                        <div class="flex flex-col items-center justify-center mb-7 font-light">
                            <img class="w-30 h-30 rounded-sm" src="{{ asset('storage').'/'.Auth::user()->profile }}" alt="">
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{ $judgeWithEvent->event->name }}</h1>
                        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-200">{{ $judgeWithEvent->event->details }}.</p>
                        <a href="{{ route('judge.candidates') }}" class="bg-slate-700 p-2 text-white hover:bg-slate-800 text-xl">Start Voting</a>
                    </div>
                    <div class="bg-gradient-to-b from-blue-50 to-transparent dark:from-blue-900 w-full h-full absolute top-0 left-0 z-0"></div>
                </section>

            </div>
        </div>
    </div>

    @if (session('response'))
        @include('judge.waiting.waiting',['message'=>session('response')]);
    @endif

    @section('scripts')
        <script>
            $(document).ready(function(){
                $('#waitingCloseBtn').click(function(){
                    $('#waitingBackdrop').addClass('hidden')
                    $('#waitingModal').addClass('hidden')
                })
            })
        </script>
    @endsection
</x-app-layout>


