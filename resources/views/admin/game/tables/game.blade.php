<div class="max-w-12xl mx-auto mb-2">


    <div class="relative overflow-x-auto sm:rounded-lg p-2 bg-slate-100">

        <div
            class="p-2 flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <span>Team's in Battle </span>
            <div class="flex items-center gap-2">
                <div
                    class="setPlayerAndCategory bg-slate-500 text-white p-1 rounded-sm hover:bg-slate-700 hover:cursor-pointer">
                    <i class="fa-solid fa-game-board-simple"></i>
                    Teams
                </div>
                {{-- {{ $activeGame }} --}}
                <div
                    id="gameResult"
                    data-active_game="{{ count($activeGame) > 0 ? $activeGame[0]->sport_category_id : 0 }}"
                    class="bg-slate-500 text-white p-1 rounded-sm hover:bg-slate-700 hover:cursor-pointer @if(count($activeGame) == 0) hidden @endif">
                    <i class="fa-solid fa-game-board-simple"></i>
                    Overview
                </div>
                <div
                    id="completedGame"
                    {{-- data-active_game="{{ count($activeGame) > 0 ? $activeGame[0]->sport_category_id : 0 }}" --}}
                    class="bg-slate-500 text-white p-1 rounded-sm hover:bg-slate-700 hover:cursor-pointer">
                    <i class="fa-solid fa-game-board-simple"></i>
                    Game Completed
                </div>

                {{-- <div>
                    <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                        class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        type="button">
                        <span class="sr-only">Action button</span>
                        Filters
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownAction"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownActionButton">
                            <li class="hover:bg-slate-100 p-4">
                                <a href="#" class="flex items-center px-2">
                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                    Online
                                </a>
                            </li>
                            <li class="hover:bg-slate-100 p-4">
                                <a href="#" class="flex items-center px-2">
                                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>
                                    Offline
                                </a>
                            </li>


                        </ul>

                    </div>
                </div> --}}

                {{-- <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="table-search-users"
                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for users">
                </div> --}}
            </div>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Team Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Players
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Scorer
                    </th>
                    {{-- <th scope="col" class="px-6 py-3">
                        Scores
                    </th> --}}

                    {{-- <th scope="col" class="px-6 py-3">
                        Action
                    </th> --}}
                </tr>
            </thead>
            <tbody>
                {{-- {{ $events }} --}}
                {{-- @foreach ($events as $ev)
                    <tr
                        class="bg-white border-b border-slate-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-100 dark:hover:bg-gray-600">
                        
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-sm"
                                src="{{ asset('storage').'/'.$ev->image }}" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-semibold">{{ $ev->name }}</div>
                                <div class="font-normal text-gray-500">Santiago City</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            {{ $ev->type }}
                        </td>
                        <td class="px-6 py-4">
                            <i class="fa-solid fa-list"></i>
                            <a href="{{ route('admin.category', $ev->id) }}" class="font-bold text-blue-500 hover:cursor-pointer hover:text-blue-700">
                                {{ count($ev->category) }}+
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <i class="fa-regular fa-user-group-simple"></i>
                            <a href="{{ route('admin.candidate', $ev->id) }}" class="font-bold text-blue-500 hover:cursor-pointer hover:text-blue-700">
                                {{ count($ev->candidates) }}+
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <i class="fa-regular fa-user-group-simple"></i>
                            <a href="{{ route('admin.judge', $ev->id) }}" class="font-bold text-blue-500 hover:cursor-pointer hover:text-blue-700">
                                {{ count($ev->judge) }}+
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @switch($ev->status)
                                    @case(0)
                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Offline
                                        @break
                                
                                    @default
                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                                @endswitch
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span>{{ \Carbon\Carbon::parse($ev->date)->format('F d, Y') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span>{{ \Carbon\Carbon::parse($ev->time)->format('h:i A') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.event.edit', $ev->id) }}"><i class="fa-solid fa-pen-to-square text-xl text-red-500 hover:text-red-700"></i></a>
                            <a href="{{ route('admin.event.start', $ev->id) }}"><i class="fa-solid fa-circle-play text-xl text-blue-500 hover:text-blue-700"></i></a>
                        </td>
                    </tr>
                @endforeach --}}
                @foreach ($inGames as $g)
                    <tr
                        class="bg-white border-b border-slate-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-100 dark:hover:bg-gray-600">

                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-sm" src="{{ asset('storage') . '/' . $g->team->profile }}"
                                alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-semibold">{{ $g->team->team_name }}</div>
                                <div class="font-normal text-gray-500">Santiago City</div>
                            </div>
                        </th>
                       
                        <td class="px-6 py-4">
                            <i class="fa-solid fa-list"></i>
                            <a href="#"
                                class="font-bold text-blue-500 hover:cursor-pointer hover:text-blue-700">
                                {{ count($g->team->players) }}+
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <span>{{ $g->sportCategory->category }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span>{{ $g->status }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-blue-500">{{ $g->team->scorer ? $g->team->scorer->judge->name : 'no scorer'}}</span>
                        </td>
                        {{-- <td class="px-6 py-4">
                            <span>0</span>
                        </td> --}}
                        
                        <td class="px-6 py-4">
                            <button type="button" class="gameBtn" data-event_id="{{ $g->sportCategory->event_id }}" data-team_id="{{ $g->team->id }}" data-game_id="{{ $g->id }}"><i
                                    class="fa-solid fa-pen-to-square text-xl text-red-500 hover:text-red-700"></i> Change</button>
                            <button type="button" class="judgeBtn" data-scorer_id="{{ $g->team->scorer ? $g->team->scorer->judge_id : 0 }}" data-event_id="{{ $g->sportCategory->event_id }}" data-team_id="{{ $g->team->id }}" data-game_id="{{ $g->id }}">
                                <i class="fa-sharp fa-solid fa-user-tie text-xl text-red-500 hover:text-red-700"></i> Judge</button>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
