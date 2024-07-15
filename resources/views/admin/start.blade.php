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
                                        <i class="fa-solid fa-users-viewfinder text-5xl mr-2"></i>
                                        <div class="text-center">
                                            <span class="block font-semibold">{{ __('Candidates') }}</span>
                                            <span>Total: <span class="font-bold">{{ count($activeEvents->candidates) }}</span></span>
                                        </div>

                                        <a href="#" id="show" class="border-b-2 text-blue-500 hover:text-blue-700">show</a>
                                    </div>
    
                                    <div class="shadow p-2 flex items-center mb-2">
                                        <i class="fa-solid fa-users-between-lines text-5xl mr-2"></i>
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
                                                                <i class="fa-solid fa-square-check text-2xl text-green-500"></i>
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
                                            <div>
                                                @if ($category->status)
                                                <i class="fa-solid fa-circle text-xs text-green-500"></i>
                                                @else
                                                <i class="fa-solid fa-circle text-xs text-red-500"></i>
                                                @endif
                                                <span>{{ $category->category_name }}</span>
                                            </div>

                                            <div>
                                                @if ($category->status)
                                                <a data-category="{{ $category->id }}" href="#" class="printResult text-blue-500 px-1 rounded-md hover:text-blue-700"><i class="fa-solid fa-print"></i></a>
                                                @endif
                                                
                                                <a data-category="{{ $category->id }}" href="#" class="editCategory text-blue-500 px-1 rounded-md hover:text-blue-700"><i class="fa-solid fa-pen-to-square"></i></a>
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
                                <div class="shadow p-2 bg-white flex gap-2">
                                <img class="w-[60px] h-[60px]" src="${path}/${c.profile}" alt="" srcset="">
                                <div class="w-full">
                                    <h1 class="font-bold">${c.name}</h1>
                                    <form action="{{ route('admin.activate.candidate') }}" method="POST" class="grid grid-cols-2 gap-1 w-[150px]">
                                        @csrf
                                        <input type="number" name="candidate_id" value="${c.id}" class="p-1 rounded-sm hidden">
                                        <input type="number" name="counter" min="10" value="${c.counter}" class="p-1 rounded-sm">
                                        <button type="submit" class="bg-red-500 text-white rounded-sm hover:bg-red-700 p-[1px]">Enable</button>
                                    </form>
                                </div>
                            </div>
                            ` 
                        });

                        $('#renderDeactivated').html(r)
                        $('#activateModalBtn').trigger('click')
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