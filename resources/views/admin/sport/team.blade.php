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
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to sports event section,
                        {{ auth()->user()->name }}
                    </span>
                </div>

                {{-- create events --}}
                <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2">


                    <div class="overflow-x-auto sm:rounded-lg grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                        {{-- team profile --}}
                        <div class="shadow">

                            <div
                                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900 text-xl">
                                <span>Team Profile</span>

                            </div>

                            <form action="{{ route('admin.sports.update.team') }}" method="post" enctype="multipart/form-data" class="">
                                @csrf
                                <input class="hidden" type="number" name="team_id" value="{{ $team->id }}">
                                <div class="shadow py-2">
                                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2 px-2">

                                        <div class="shadow flex justify-center">
                                            <img class="w-24 h-24" src="{{ asset('storage').'/'.$team->profile }}"
                                                alt="" srcset="">
                                        </div>
                                        <div class="shadow col-span-2 px-1">
                                            <label for="team_image">Update Profile</label>
                                            <input type="file" name="team_image" class="block w-full rounded-md"
                                                value="{{ old('team_image') }}">
                                            @error('team_image')
                                                <span class="text-red-500">Uploading Team Image is required.</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-3">
                                            <div class="px-1">
                                                <label for="team_name">Team Name</label>
                                                <input type="text" name="team_name" class="block p-2 w-full rounded-md"
                                                    value="{{ $team->team_name }}">
                                                @error('team_name')
                                                    <span class="text-red-500">Name of team is required.</span>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="shadow col-span-3 px-1">
                                            <button type="submit"
                                                class="bg-blue-500 hover:cursor-pointer hover:bg-blue-700 p-1 w-full text-white rounded-sm">Update
                                                Profile</button>
                                        </div>
                                    </div>

                                </div>

                                
                            </form>

                        </div>

                        {{-- Participants --}}
                        <div>

                            <div
                                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900 text-xl">
                                <span>Team Members</span>

                            </div>

                            <form action="{{ route('admin.sports.store.player') }}" method="post" enctype="multipart/form-data" class="">
                                @csrf
                                <input class="hidden" type="number" name="team_id" value="{{ $team->id }}">
                                <div class="shadow py-2">
                                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2 px-2">

                                        <div class="shadow flex justify-center">
                                            <img class="w-24 h-24" src="{{ asset('storage').'/'.$team->profile }}"
                                                alt="" srcset="">
                                        </div>
                                        <div class="shadow col-span-2 px-1">
                                            <label for="player_profile">Player Profile</label>
                                            <input type="file" name="player_profile" class="block w-full rounded-md"
                                                value="{{ old('player_profile') }}">
                                            @error('player_profile')
                                                <span class="text-red-500">Uploading Player Profile is required.</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-3">
                                            <div class="px-1">
                                                <label for="player_name">Player Name</label>
                                                <input type="text" name="player_name" class="block p-2 w-full rounded-md"
                                                    value="">
                                                @error('player_name')
                                                    <span class="text-red-500">Name of player is required.</span>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="shadow col-span-3 px-1">
                                            <button type="submit"
                                                class="bg-blue-500 hover:cursor-pointer hover:bg-blue-700 p-1 w-full text-white rounded-sm">Save
                                                Member's</button>
                                        </div>
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
                    <h1 class="text-sm md:text-xl lg:text-xl">Player's</h1>
                    {{-- <button id="openCode" data-event_id="{{ $event->id }}" type="button" class="bg-slate-700 text-white px-1 rounded-sm hover:bg-slate-800"><i class="fa-solid fa-print"></i> code</button> --}}
                </div>
                <div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
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
                            @foreach ($team->players as $p)
                                <tr class="bg-white border-b border-slate-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-100 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">
                                        {{ $p->id }}
                                    </td>
                                    <th scope="row"
                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <img class="w-10 h-10 rounded-sm"
                                                src="{{ asset('storage').'/'.$p->profile }}" alt="Jese image">
                                            <div class="ps-3">
                                                <div class="text-base font-semibold">{{ $p->name }}</div>
                                            </div>
                                        </th>
                                    
                                    <td class="px-6 py-4">
                                        {{ $p->created_at }}
                                    </td>
                                    <td class="px-6 py-4 text-blue-500">
                                        <a href="#" data-candidate_id="{{ $p->id }}" class="editCandidate">
                                            <i class="fa-solid fa-pen-to-square text-xl hover:text-blue-700"></i>
                                        </a>
                                        <a href="{{ route('admin.candidate.destroy', $p->id) }}">
                                            <i class="fa-solid fa-square-minus text-xl text-red-500 hover:text-red-700"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @section("scripts")
        <script>
            let success = @json(session('success'));
            let message = @json(session('message'));
            // console.log(success)
            $(document).ready(function(){
                if(success !== null){
                    Swal.fire({
                        title: "Successfully!",
                        text: message,
                        icon: "success"
                    });
                }
            })
        </script>
    @endsection
</x-app-layout>
