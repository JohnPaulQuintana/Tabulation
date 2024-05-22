<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section' => 'Add Candidates'])
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 p-2">
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to candidate section,
                        {{ auth()->user()->name }}
                    </span>
                </div>

                {{-- create judge --}}
                <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2">


                    <div class="overflow-x-auto sm:rounded-lg">
                        <div>

                            <form action="{{ route('admin.candidate.store') }}" method="post" enctype="multipart/form-data"
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
                                            <span class="font-bold uppercase text-blue-500">{{ $event->name }}</span>
                                            <p>{{ $event->details }}</p>
                                            <p class="text-blue-500">{{ $event->created_at->format('F j, Y') }}</p>
                                        </div>
                                        <div class="shadow col-span-3 p-2">
                                            <span class="font-bold">Category</span>
                                            @foreach ($event->category as $c)
                                                <div class="flex items-center gap-2 p-1 bg-slate-100 capitalize">
                                                    <i class="fa-solid fa-circle text-[8px] text-green-500"></i>
                                                    <span>{{ $c->category_name }}</span>
                                                </div>
                                            @endforeach
                                        </div>


                                    </div>

                                </div>

                                <div class="shadow py-2">
                                    <div class="shadow px-1 mb-2">
                                        <h1 class="text-center font-bold p-1 uppercase bg-slate-700 text-white">Add a
                                            new candidates</h1>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">

                                        <div class="shadow col-span-2 px-1 mb-2">
                                            <label for="profile">Candidate Profile</label>
                                            <input type="file" name="profile" class="p-2 w-full rounded-md" value="{{ old('profile') }}">
                                            @error('profile')
                                                <span class="text-red-500">Profile is required.</span>
                                            @enderror
                                        </div>

                                        <div class="shadow px-1 mb-2">
                                            <label for="name">Candidate Name</label>
                                            <input type="text" name="name" class="p-2 w-full rounded-md" value="{{ old('name') }}">
                                            <input type="text" name="event_id" class="p-2 w-full rounded-md hidden" value="{{ $event->id }}">
                                            @error('name')
                                                <span class="text-red-500">Name is required.</span>
                                            @enderror
                                        </div>

                                        <div class="shadow px-1 mb-2">
                                            <label for="age">Candidate Age</label>
                                            <input type="number" name="age" class="p-2 w-full rounded-md" value="{{ old('age') }}">
                                            @error('age')
                                                <span class="text-red-500">Age is required.</span>
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
                                    <td class="px-6 py-4 flex gap-1 items-center font-bold">
                                        <i class="fa-solid fa-circle text-[8px] text-green-500"></i>
                                        {{ $j->name }}
                                    </td>
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
                                        <a href="#">
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

        @if (session('candidate-status'))
            @include('admin.popup.candidate')
        @endif
        
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#candidateCloseBtn').click(function(){
                    // alert('dwadwad')
                    $('#candidateBackdrop').addClass('hidden')
                    $('#candidateModal').addClass('hidden')
                })
            })
        </script>
    @endsection
</x-app-layout>
