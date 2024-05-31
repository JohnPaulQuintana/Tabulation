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

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 p-2">
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to judge section,
                        {{ auth()->user()->name }}
                    </span>
                </div>

                {{-- create judge --}}
                <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2">


                    <div class="overflow-x-auto sm:rounded-lg">
                        <div>

                            <form action="{{ route('admin.judge.store') }}" method="post" enctype="multipart/form-data"
                                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                                @csrf
                                <div class="shadow py-2">
                                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2 px-2">
                                        <div class="shadow px-1 col-span-3">
                                            <h1 class="text-center font-bold p-1 uppercase bg-slate-700 text-white">
                                                Event Details</h1>
                                        </div>
                                        <div class="shadow flex justify-center items-center bg-slate-100">
                                            <img class="w-fit h-full" src="{{ asset('storage') . '/' . $event->image }}"
                                                alt="" srcset="">
                                        </div>
                                        <div class="shadow col-span-2 px-1 bg-slate-100">
                                            <h1 class="font-bold uppercase text-slate-500 text-center">{{ $event->name }}</h1>
                                            <p>{{ $event->details }}</p>
                                            <p class="text-white bg-slate-500 text-center">Date: {{ $event->created_at->format('F j, Y') }}</p>
                                            <div class="shadow p-2">
                                                <span class="font-bold">Category</span>
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach ($event->category as $c)
                                                        <div class="flex items-center gap-2 p-1 bg-slate-50 capitalize shadow-2 rounded-sm">
                                                            @if ($c->status)
                                                                <i class="fa-solid fa-circle text-[8px] text-green-500"></i>
                                                            @else
                                                                <i class="fa-solid fa-circle text-[8px] text-red-500"></i>
                                                            @endif
                                                            <span>{{ $c->category_name }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        


                                    </div>

                                </div>

                                <div class="shadow py-2">
                                    <div class="shadow px-1">
                                        <h1 class="text-center font-bold p-1 uppercase bg-slate-700 text-white">Add a
                                            new judge</h1>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="shadow px-1 mb-2">
                                            <label for="profile">Judge Profile</label>
                                            <input type="file" name="profile" class="p-2 w-full rounded-md" value="{{ old('profile') }}">
                                            @error('profile')
                                                <span class="text-red-500">Profile is required.</span>
                                            @enderror
                                        </div>
                                        <div class="shadow px-1 mb-2">
                                            <label for="name">Judge Name</label>
                                            <input type="text" name="name" class="p-2 w-full rounded-md" value="{{ old('name') }}">
                                            <input type="text" name="event_id" class="p-2 w-full rounded-md hidden" value="{{ $event->id }}">
                                            @error('name')
                                                <span class="text-red-500">Name is required.</span>
                                            @enderror
                                        </div>
                                        <div class="shadow px-1 mb-2">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" class="block p-2 w-full rounded-md"
                                                value="{{ old('address') }}">
                                            @error('address')
                                                <span class="text-red-500">Address is required.</span>
                                            @enderror
                                        </div>
                                        <div class="shadow px-1 mb-2">
                                            <label for="position">Position</label>
                                            <input type="text" name="position" class="block p-2 w-full rounded-md"
                                                value="{{ old('position') }}">
                                            @error('position')
                                                <span class="text-red-500">Position is required.</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="shadow px-1 flex gap-2">
                                        <a href="{{ route('admin.event') }}"
                                            class="w-full p-2 bg-red-500 hover:bg-red-700 text-white text-center">Cancel</a>
                                        <button type="submit"
                                            class="w-full p-2 bg-blue-500 hover:bg-blue-700 text-white">Save
                                            Judge</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center px-6 p-2">
                    <h1 class="text-sm md:text-xl lg:text-xl">Created Judge</h1>
                    <button id="openCode" data-event_id="{{ $event->id }}" type="button" class="bg-slate-700 text-white px-1 rounded-sm hover:bg-slate-800"><i class="fa-solid fa-print"></i> code</button>
                </div>
                <div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Position
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Code
                                </th>
                                
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($event->judge as $j)
                                <tr class="bg-white border-b border-slate-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-100 dark:hover:bg-gray-600">
                                    <th scope="row"
                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <img class="w-10 h-10 rounded-sm"
                                                src="{{ asset('storage').'/'.$j->profile }}" alt="Jese image">
                                            <div class="ps-3">
                                                <div class="text-base font-semibold">{{ $j->name }}</div>
                                            </div>
                                        </th>
                                    <td class="px-6 py-4">
                                        {{ $j->address }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $j->position }}
                                    </td>
                                    <td class="px-6 py-4 flex items-center gap-1 text-green-500 font-bold">
                                        <i class="fa-solid fa-circle text-[8px]"></i>
                                        {{ $j->code }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $j->created_at }}
                                    </td>
                                    <td class="px-6 py-4 text-blue-500">
                                        <a href="#" data-judge_id="{{ $j->id }}" class="editJudge">
                                            <i class="fa-solid fa-pen-to-square text-xl hover:text-blue-700"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @include('admin.judge.template.code')
        @include('admin.judge.edit')

        @if (session('judge-save'))
            @include('admin.popup.judge',['message'=>session('message')])
        @endif
        
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                let judges = @json($event->judge);
                // console.log(judges)
                $('#judgeCloseBtn').click(function(){
                    $('#judgeBackdrop').addClass('hidden')
                    $('#judgeModal').addClass('hidden')
                })

                $('#openCode').click(function(){
                    let eventID = $(this).data('event_id')
                    let data = {
                        'event_id': eventID,
                    }
                    let codeRender = ''
                    sendRequest('POST', '/admin/judge/code', data )
                    .then(response => {
                        console.log('Success:', response.codes.judge);
                        response.codes.judge.forEach(c => {
                            codeRender += `
                            <div class="border-2 p-2 text-center text-slate-700 uppercase rounded-sm">
                                <h1 class="tracking-wide text-xl">${c.name}</h1>
                                <div class="flex flex-col">
                                    <span class="font-bold">CODE</span>
                                    <span class="font-bold text-green-700">${c.code}</span>
                                </div>
                            </div>
                            `
                        });
                        $('#renderCode').html(codeRender)
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

                    $('#codeModal').removeClass('hidden')
                    $('#codeBackdrop').removeClass('hidden')
                })

                $('#printCancelBtn').click(function(){
                    $('#codeModal').addClass('hidden')
                    $('#codeBackdrop').addClass('hidden')
                })

                $('#editJudgeCloseBtn').click(function(){
                    $('#editJudgeBackdrop').addClass('hidden')
                    $('#editJudgeModal').addClass('hidden')
                })

                $('.editJudge').click(function(){
                    // alert()
                    let judgeId = $(this).data('judge_id');
                    let renderJudge = ''
                    judges.forEach(j=>{
                        if(j.id === judgeId){
                            console.log(j)
                            renderJudge = `
                            <input type="number" name="judge_id" id="judge_id" value="${j.id}" class="hidden">
                            <div class="flex flex-col shadow mb-2 p-2">
                                <label for="">Profile:</label>
                                <div class="flex gap-2 items-center">
                                    <img class="w-30 h-30 rounded-md" src="{{ asset('storage') }}/${j.profile}" alt="profile">
                                    <input type="file" id="judge_profile" name="judge_profile" value="" class="rounded-md flex-1">
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 shadow mb-2 p-2">
                                <div class="grid grid-cols-2 gap-2 items-center shadow mb-2 p-2">
                                    <div class="">
                                        <label for="">Name:</label>
                                        <input type="text" name="name" id="judge_name" value="${j.name}" class="rounded-md w-full">
                                    </div>
                                    
                                    <div class="">
                                        <label for="">Position:</label>
                                        <input type="text" name="position" id="judge_position" value="${j.address}" class="rounded-md w-full">
                                    </div>
                                    <div class="col-span-2">
                                        <label for="">Address:</label>
                                        <input type="text" name="address" id="judge_address" value="${j.position}" class="rounded-md w-full">
                                    </div>
                                </div>
                            </div>
                            `
                            $('#renderEditJudgeContainer').html(renderJudge)

                            $('#editJudgeBackdrop').removeClass('hidden')
                            $('#editJudgeModal').removeClass('hidden')
                        }
                    })
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
                    var contents = document.getElementById("code-container").innerHTML;
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
