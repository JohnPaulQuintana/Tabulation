<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section' => 'Event Started'])
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to event section, where the event started!
                        {{ auth()->user()->name }}</span>
                </div>

                <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2">
                    {{-- event name --}}
                    <div class="relative overflow-x-auto sm:rounded-lg p-2 bg-slate-100 mb-2">
                        <div class="p-2 flex flex-col gap-2 items-center justify-between flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                            <div class="flex justify-between items-center w-full">
                                <p class="w-full">Active Event</p>
                                <div>
                                    
                                    
                                    <button id="dropdownRadioBgHoverButton" data-dropdown-toggle="dropdownRadioBgHover" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Status <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                        </svg>
                                        </button>
                                        
                                        <!-- Dropdown menu -->
                                        <div id="dropdownRadioBgHover" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRadioBgHoverButton">
                                                <li>
                                                    <form action="{{ route('admin.event.setStatus') }}" method="POST">
                                                        <input type="number" name="event_id" value="{{ $activeEvents->id }}" class="hidden">
                                                        @csrf
                                                        <div class="flex items-center p-2 rounded hover:bg-slate-100 hover:cursor-pointer">
                                                            <input @if($activeEvents->status === 0) checked @endif id="default-radio-4" type="radio" value="0" name="set_status" onchange="this.form.submit()" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 hover:cursor-pointer">
                                                            <label for="default-radio-4" class="w-full ms-2 text-sm font-medium text-red-500 rounded hover:cursor-pointer">Offline</label>
                                                        </div>
                                                        <div class="flex items-center p-2 rounded hover:bg-slate-100 hover:cursor-pointer">
                                                            <input @if($activeEvents->status === 1) checked @endif id="default-radio-5" type="radio" value="1" name="set_status" onchange="this.form.submit()" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 hover:cursor-pointer">
                                                            <label for="default-radio-5" class="w-full ms-2 text-sm font-medium text-blue-500 rounded dark:text-gray-300 hover:cursor-pointer">Online</label>
                                                        </div>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
    
    
    
                                </div>
                            </div>
                            <div class="w-full grid grid-cols-4 gap-2">

                                <div>
                                    <div class="shadow p-2 flex items-center mb-2">
                                        <img class="w-16 h-16" src="{{ asset('storage').'/'.$activeEvents->image }}" alt="">
                                        <div class="text-center">
                                            <span class="block font-semibold">{{ $activeEvents->name }}</span>
                                            <span>{{ $activeEvents->address }}</span>
                                        </div>
                                    </div>
    
                                    <div class="shadow p-2 flex flex-wrap items-center mb-2">
                                        {{-- <i class="fa-solid fa-users-viewfinder text-5xl mr-2"></i> --}}
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[50px] h-50px mr-2" fill="#64748b" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H544c53 0 96-43 96-96V96c0-53-43-96-96-96H96zM64 96c0-17.7 14.3-32 32-32H544c17.7 0 32 14.3 32 32V416c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V96zm159.8 80a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM96 309.3c0 14.7 11.9 26.7 26.7 26.7h56.1c8-34.1 32.8-61.7 65.2-73.6c-7.5-4.1-16.2-6.4-25.3-6.4H149.3C119.9 256 96 279.9 96 309.3zM461.2 336h56.1c14.7 0 26.7-11.9 26.7-26.7c0-29.5-23.9-53.3-53.3-53.3H421.3c-9.2 0-17.8 2.3-25.3 6.4c32.4 11.9 57.2 39.5 65.2 73.6zM372 289c-3.9-.7-7.9-1-12-1H280c-4.1 0-8.1 .3-12 1c-26 4.4-47.3 22.7-55.9 47c-2.7 7.5-4.1 15.6-4.1 24c0 13.3 10.7 24 24 24H408c13.3 0 24-10.7 24-24c0-8.4-1.4-16.5-4.1-24c-8.6-24.3-29.9-42.6-55.9-47zM512 176a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM320 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128z"/></svg>
                                        </div>
                                        <div class="text-center">
                                            <span class="block font-semibold">{{ __('Candidates') }}</span>
                                            <span>Total: <span class="font-bold">{{ count($activeEvents->candidates) }}</span></span>
                                        </div>

                                        <a href="#" id="show" class="border-b-2 text-blue-500 hover:text-blue-700">show</a>
                                    </div>
    
                                    <div class="shadow p-2 flex items-center mb-2">
                                        {{-- <i class="fa-solid fa-users-between-lines text-5xl mr-2"></i> --}}
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[50px] h-50px mr-2" fill="#64748b" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0H616c13.3 0 24 10.7 24 24s-10.7 24-24 24H24C10.7 48 0 37.3 0 24zM0 488c0-13.3 10.7-24 24-24H616c13.3 0 24 10.7 24 24s-10.7 24-24 24H24c-13.3 0-24-10.7-24-24zM83.2 160a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM32 320c0-35.3 28.7-64 64-64h96c12.2 0 23.7 3.4 33.4 9.4c-37.2 15.1-65.6 47.2-75.8 86.6H64c-17.7 0-32-14.3-32-32zm461.6 32c-10.3-40.1-39.6-72.6-77.7-87.4c9.4-5.5 20.4-8.6 32.1-8.6h96c35.3 0 64 28.7 64 64c0 17.7-14.3 32-32 32H493.6zM391.2 290.4c32.1 7.4 58.1 30.9 68.9 61.6c3.5 10 5.5 20.8 5.5 32c0 17.7-14.3 32-32 32h-224c-17.7 0-32-14.3-32-32c0-11.2 1.9-22 5.5-32c10.5-29.7 35.3-52.8 66.1-60.9c7.8-2.1 16-3.1 24.5-3.1h96c7.4 0 14.7 .8 21.6 2.4zm44-130.4a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM321.6 96a80 80 0 1 1 0 160 80 80 0 1 1 0-160z"/></svg>
                                        </div>
                                        <div class="text-center">
                                            <span class="block font-semibold">{{ __('Judge') }}</span>
                                            <span>Total: <span class="font-bold">{{ count($activeEvents->judge) }}</span></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-slate-50 col-span-3 p-2">
                                    <div class="flex justify-between items-center">
                                        <h1 class="uppercase font-semibold">Candidates Leading in Votes</h1>
                                        <span id="overallPrint" class="bg-red-500 p-1 text-white rounded-sm hover:cursor-pointer hover:bg-red-700">Print Overall</span>
                                    </div>
                                    <div class="h-[200px] overflow-y-auto" id="overAllContent">
                                        <div class="bg-green-500 text-white p-2 text-center md:hidden">
                                            <h1 class="text-2xl tracking-wider">Overall Result's</h1>
                                            <span>Date and Time: {{ now()->format('F j, Y, g:i A') }}</span>
                                        </div>
                                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 bg-white">
                                            <thead
                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="p-4">
                                                        {{-- <div class="flex items-center">
                                                            <i class="fa-solid fa-circle-check text-xl text-"></i>
                                                        </div> --}}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Name
                                                    </th>
                                                    {{-- <th scope="col" class="px-6 py-3">
                                                        Category
                                                    </th> --}}
                                                    <th scope="col" class="px-6 py-3">
                                                        Overall Votes (%)
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Percentage
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    // Extract candidates and sort by vote_results['total'] in descending order
                                                    $sortedCandidates = $activeEvents->candidates->sortByDesc(function($candidate) {
                                                        return $candidate->vote_results['total'];
                                                    });
                                                @endphp

                                                @foreach ($sortedCandidates as $candidate)
                                                    <tr class="bg-white border-b border-slate-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-100 dark:hover:bg-gray-600">
                                                        <td class="w-4 p-4">
                                                            <div class="flex items-center">
                                                                {{-- <i class="fa-solid fa-square-check text-2xl text-green-500"></i> --}}
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px]" fill="#0e9f6e" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                                                            </div>
                                                        </td>
                                                        <td scope="row"
                                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                            <img class="w-10 h-10 rounded-sm"
                                                                src="{{ asset('storage').'/'.$candidate->profile }}" alt="Jese image">
                                                            <div class="ps-3">
                                                                <div class="text-base font-semibold">{{ $candidate->name }}</div>
                                                                <div class="font-normal text-gray-500">Santiago City</div>
                                                            </div>
                                                        </td>
                                                        {{-- <td class="p-4">
                                                            <div class="flex items-center">
                                                                {{ $activeCategory->category_name }}
                                                            </div>
                                                        </td> --}}
                                                        <td class="p-4">
                                                            <div class="flex items-center font-bold {{ $candidate->vote_results['total'] > 80 ? 'text-green-500' : 'text-red-500' }}">
                                                                {{ $candidate->vote_results['total'] }}%
                                                            </div>
                                                        </td>
                                                        <td class="p-4">
                                                            <div class="flex items-center font-bold text-green-500">
                                                                {{ __('100%') }}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- category set --}}
                    <div class="relative overflow-x-auto sm:rounded-lg p-2 bg-slate-100">
                        <div class="p-2 flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                            <span class="w-full">Event Category</span>
                            <div class="flex gap-4">
                                {{-- {{ $activeEvents->category }} --}}
                                @foreach ($activeEvents->category as $category)
                                    <div class="flex-shrink-0 w-64 shadow p-4 items-center">
                                        <h1 class="font-semibold mb-2 flex justify-between items-center">
                                            <div class="flex gap-1 items-center">
                                                @if ($category->status)
                                                {{-- <i class="fa-solid fa-circle text-xs text-green-500"></i> --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-[10px] h-[10px]" fill="#0e9f6e" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                                                @else
                                                {{-- <i class="fa-solid fa-circle text-xs text-red-500"></i> --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-[10px] h-[10px]" fill="#f05252" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                                                @endif
                                                <span>{{ $category->category_name }}</span>
                                            </div>

                                            <div class="flex gap-1 items-center">
                                                @if ($category->status)
                                                <a data-category="{{ $category->id }}" href="#" class="printResult text-blue-500 px-1 rounded-md hover:text-blue-700">
                                                    {{-- <i class="fa-solid fa-print"></i> --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[15px] h-[15px]" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                                                </a>
                                                @endif
                                                
                                                <a data-category="{{ $category->id }}" href="#" class="editCategory text-blue-500 px-1 rounded-md hover:text-blue-700">
                                                    {{-- <i class="fa-solid fa-pen-to-square"></i> --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[15px] h-[15px]" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                </a>
                                            </div>
                                        </h1>
                                        @foreach ($category->subCategory as $sub)
                                            <div class="flex justify-between items-center gap-2 bg-slate-100 p-1 capitalize">
                                                <span>{{ $sub->sub_category }}</span>
                                                <span>{{ $sub->percentage }}%</span>
                                            </div>
                                        @endforeach

                                        <div class="py-2 mx-auto flex flex-col gap-2 items-center">
                                            @switch($category->status)
                                                @case(false)
                                                    <a href="{{ route('admin.event.start.voting', $category->id) }}" class="rounded-md bg-blue-500 w-full text-white text-center hover:bg-blue-700 p-1">activate</a>
                                                    @break
                                                @case(true)
                                                    <a href="#" class="rounded-md bg-slate-100 w-full text-yellow-400 text-center p-1">in-progress...</a>
                                                    <a href="{{ route('admin.event.cancel', $category->id) }}" class="rounded-md bg-red-500 w-full text-white text-center p-1 hover:bg-red-700">Cancel</a>
                                                    @break
                                                {{-- @case("3")
                                                    <a href="#" class="rounded-md bg-slate-100 w-full text-yellow-400 text-center hover:bg-blue-700 p-1">in-progress...</a>
                                                    @break --}}
                                            
                                                @default
                                                    
                                            @endswitch
                                            
                                        </div>
                                    </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @include('admin.popup.status', ['status'=>session('status')]) --}}
        @if (session('status'))
            @include('admin.popup.status', ['status'=>session('status')])
        @endif
        @if (session('updates'))
            @include('admin.popup.update', ['status'=>session('updates')])
        @endif

        @include('admin.category.edit')
        @include('admin.print.print')
        @include('admin.popup.activate')
        @section('scripts')
            <script>
                let dataToPrint = @json($dataToPrint);
                // console.log(dataToPrint)
                let leadingCandidatesPerCat = @json($leadingCandidatesForCategory);

                // console.log(leadingCandidatesPerCat)
                leadingCandidatesPerCat = leadingCandidatesPerCat.sort((a, b) => {
                    // Check if percentage_scores and percentage_scores[0] are defined and provide default values if not
                    const a_total = (a.percentage_scores && a.percentage_scores[0] && a.percentage_scores[0].total_percentage) || 0;
                    const b_total = (b.percentage_scores && b.percentage_scores[0] && b.percentage_scores[0].total_percentage) || 0;

                    return b_total - a_total;
                });
                // console.log(leadingCandidatesPerCat)
                $(document).ready(function(){

                    //check if there is activated candidate for notification
                const notifyInterval = setInterval(function(){
                    sendRequest("GET", "{{ route('admin.notify') }}")
                    .then(function(res){
                        console.log(res.data)
                        let path = "{{ asset('storage') }}"
                        if(res.data !== null){
                            clearInterval(notifyInterval); // Stop the timer when it reaches 0
                            Swal.fire({
                                title: `${res.data.name}`,
                                text: `Requesting to edit Candidate: ${res.candidate.name}`,
                                imageUrl: `${path}/${res.data.profile}`,
                                imageWidth: 100,
                                imageHeight: 100,
                                imageAlt: "Custom image",
                                allowOutsideClick: false // Disable outside click to close the alert
                            }).then((result) => {
                                    if (result.isConfirmed) {
                                        let data = {'id': res.data.id}
                                        sendRequest("get", "{{ route('judge.notify.update') }}", data)
                                        .then(function(res){
                                            console.log(res)
                                            if(res.status === 'success'){
                                                window.location.reload();
                                            }
                                        })
                                        .catch(function(err){
                                            console.log(err)
                                        })
                                        // window.location.reload();
                                    }
                                });;

                        }
                        
                    })
                    .catch(function(err){
                        console.log(err)
                    })
                    // console.log(data)
                }, 1000)

                    //debug
                    // $('#activateModalBtn').trigger('click')
                    $('#statusCloseBtn').click(function(){
                        // alert('yes')
                        $('#statusBackdrop').addClass('hidden')
                        $('#statusModal').addClass('hidden')
                    })
                    $('#updatedCloseBtn').click(function(){
                        $('#updatedBackdrop').addClass('hidden')
                        $('#updatedModal').addClass('hidden')
                    })

                    //show all candidates
                    $('#show').click(function(){
                        // alert('yes')
                        candidates = leadingCandidatesPerCat.sort((a,b)=>{return a.id - b.id});
                        console.log(candidates)
                        let r = ''
                        let path = "{{ asset('storage') }}"
                        candidates.forEach(c => {
                            r += `
                                <div class="shadow p-2 bg-white ${c.isActive ? 'border border-green-500' : ''} flex gap-2">
                                <img class="w-[60px] h-[60px]" src="${path}/${c.profile}" alt="" srcset="">
                                <div class="w-full">
                                    <h1 class="font-bold">${c.name}</h1>
                                    <form action="{{ route('admin.activate.candidate') }}" method="POST" class="grid grid-cols-2 gap-1 w-[150px]">
                                        @csrf
                                        <input type="number" name="requested_id" value="${c.requested}" class="p-1 rounded-sm hidden">
                                        <input type="number" name="candidate_id" value="${c.id}" class="p-1 rounded-sm hidden">
                                        <input type="number" name="counter" min="10" value="${c.counter}" class="p-1 rounded-sm">
                                        <button type="submit" class="${c.isActive ? 'bg-green-500' : "bg-red-500  hover:bg-red-700"} text-white rounded-sm p-[1px]" ${c.isActive ? 'disabled' : ""}>${c.isActive ? 'Enabled' : 'Enable'}</button>
                                    </form>
                                </div>
                            </div>
                            ` 
                        });

                        $('#renderDeactivated').html(r)
                        $('#activateModalBtn').trigger('click')
                    })

                    //exit Active
                    $('.exitActivate').click(function(){
                        window.location.reload();
                    })


                    $('.editCategory').click(function(){
                        // alert($(this).data('category'))
                        let data = {id:$(this).data('category')}
                        let renderCriteria = ''
                        sendRequest('GET', '{{ route('admin.category.edit') }}', data)
                            .then(function(res){
                                console.log(res)
                                res.category.sub_category.forEach(sc => {
                                    console.log(sc)
                                    renderCriteria += `
                                    <div class="flex gap-2 justify-between items-center shadow mb-2 p-2">
                                        <div class="">
                                            <label for="">Criteria:</label>
                                            <input type="text" name="criteria[]" value="${sc.sub_category}" class="rounded-md w-full">
                                        </div>
                                        
                                        <div class="">
                                            <label for="">Percentage:</label>
                                            <input type="number" name="percentage[]" value="${sc.percentage}" class="rounded-md w-full">
                                        </div>
                                    </div>
                                    `
                                });
                                $('#type').val('start')
                                $('#category_id').val(res.category.id)
                                $('#category_name').val(res.category.category_name)
                                $('#renderEditCriteriaContainer').html(renderCriteria)
                                $('#editBackdrop').removeClass('hidden')
                                $('#editModal').removeClass('hidden')
                            })
                            .catch(function(err){
                                console.log(err)
                            })
                    })

                    //print result
                    $('.printResult').click(function(){
                        let id = $(this).data('category')

                        //leading
                        let renderLeading = ''
                        let path = "{{ asset('storage') }}"
                        leadingCandidatesPerCat.forEach(l => {
                            console.log(l)
                            let l_total = (l.percentage_scores && l.percentage_scores[0] && l.percentage_scores[0].total_percentage) || 0;
                            // const l_total = (b.percentage_scores && b.percentage_scores[0] && b.percentage_scores[0].total_percentage) || 0;

                            renderLeading += `
                                <div class="shadow text-center px-2 flex gap-2 bg-white">
                                    <img class="w-[50px]" src="${path}/${l.profile}" alt="">
                                    <div class="">
                                        <span class="text-xs font-bold">${l.name}</span>
                                        <span class="block uppercase text-sm font-bold ${l_total >= 80 ? 'text-green-500' : 'text-red-500'}">
                                            ${l_total}%
                                        </span>    
                                    </div>
                                </div> 
                            `
                        });

                        $('#renderVoteCategoryLeadingResult').html(renderLeading)
                        // alert(id)
                        dataToPrint.forEach(d => {
                            if(d.id == id){
                                // console.log(d)
                                let renderData = ''
                                $('#selectedCategory').text(d.category_name)
                                $('#selectedCategoryLeading').text(d.category_name)

                                d.event.judge.forEach(j => {
                                    // console.log(j)
                                    let renderCandidates = ''
                                    j.votes.forEach(v => {
                                        let percentageScorePerJudge = 0;
                                        v.candidate.percentage_scores.forEach(sc => {
                                            // console.log(sc)
                                            if(j.id === sc.judge_id){
                                                percentageScorePerJudge = sc.total_score
                                            }
                                        });
                                        renderCandidates += `
                                            <div class="shadow text-center px-2 bg-white">
                                                <span class="text-xs">${v.candidate.name}</span>
                                                <span class="block uppercase text-sm font-bold ${percentageScorePerJudge >= 40 ? 'text-green-500' : 'text-red-500'}">${percentageScorePerJudge}%</span>
                                            </div>
                                        `
                                        
                                    });
                                    renderData += `
                                    <div class="flex items-center gap-2 border border-slate-500 p-2">
                                        <div class="shadow text-center px-2">
                                            <span class="text-xs">Name:</span>
                                            <span class="block uppercase text-sm font-bold">${j.name}</span>
                                        </div>
                                        
                                        <div class="flex-1 flex gap-2 flex-wrap">
                                            ${renderCandidates}
                                        </div>
                                        
                                        <div class="shadow px-2 text-end">
                                            <span class="text-xs mx-4">Signature</span>
                                            <span class="block uppercase text-sm font-bold">____________</span>
                                        </div>  
                                    </div>   
                                    `
                                });

                                $('#renderVoteCategoryResult').html(renderData)
                                $('#printModalGame').trigger('click')
                            }
                        });
                    })

                    //ttigger print
                    $('#printNow').click(function(){
                        PrintDiv()
                    })

                    //overall print
                    $('#overallPrint').click(function(){
                        PrintDivOverall()
                    })

                    $('#editCloseBtn').click(function(){
                        $('#editBackdrop').addClass('hidden')
                        $('#editModal').addClass('hidden')
                    })
                })

                //dynamic request
                function sendRequest(method, url, data = {}) {
                    return new Promise(function(resolve, reject) {
                        // Get the CSRF token from the meta tag
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');

                        // Add the CSRF token to the data object
                        data._token = csrfToken;

                        $.ajax({
                            method: method,
                            url: url,
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // Include CSRF token in the request headers
                            },
                            success: function(response) {
                                resolve(response);
                            },
                            error: function(xhr, status, error) {
                                reject(error);
                            }
                        });
                    });
                }

                const PrintDiv = ()=> {
                    var contents = document.getElementById("contents").innerHTML;
                    var frame1 = document.createElement('iframe');
                    frame1.name = "frame1";
                    frame1.style.position = "absolute";
                    frame1.style.top = "-1000000px";
                    document.body.appendChild(frame1);
                    var frameDoc = (frame1.contentWindow) ? frame1.contentWindow : (frame1.contentDocument.document) ? frame1.contentDocument.document : frame1.contentDocument;
                    frameDoc.document.open();
                    frameDoc.document.write(`<html><head><title>DIV Contents</title>`);
                        // Copy stylesheets from main document to iframe
                        var styles = document.querySelectorAll('link[rel="stylesheet"]');
                        styles.forEach(function(style) {
                            frameDoc.document.write(style.outerHTML);
                        });
                    frameDoc.document.write('</head><body>');
                    frameDoc.document.write(contents);
                    frameDoc.document.write('</body></html>');
                    frameDoc.document.close();
                    setTimeout(function () {
                        window.frames["frame1"].focus();
                        window.frames["frame1"].print();
                        document.body.removeChild(frame1);
                    }, 500);
                    return false;
                }
                const PrintDivOverall = ()=> {
                    var contents = document.getElementById("overAllContent").innerHTML;
                    var frame1 = document.createElement('iframe');
                    frame1.name = "frame1";
                    frame1.style.position = "absolute";
                    frame1.style.top = "-1000000px";
                    document.body.appendChild(frame1);
                    var frameDoc = (frame1.contentWindow) ? frame1.contentWindow : (frame1.contentDocument.document) ? frame1.contentDocument.document : frame1.contentDocument;
                    frameDoc.document.open();
                    frameDoc.document.write(`<html><head><title>DIV Contents</title>`);
                        // Copy stylesheets from main document to iframe
                        var styles = document.querySelectorAll('link[rel="stylesheet"]');
                        styles.forEach(function(style) {
                            frameDoc.document.write(style.outerHTML);
                        });
                    frameDoc.document.write('</head><body>');
                    frameDoc.document.write(contents);
                    frameDoc.document.write('</body></html>');
                    frameDoc.document.close();
                    setTimeout(function () {
                        window.frames["frame1"].focus();
                        window.frames["frame1"].print();
                        document.body.removeChild(frame1);
                    }, 500);
                    return false;
                }
            </script>
        @endsection
</x-app-layout>