<div class="text-center hidden">
    <button id="resultModalGame" type="button"
        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
        data-hs-overlay="#hs-game-result">
        Open modal
    </button>
</div>

<div id="hs-game-result"
    class="hs-overlay hs-overlay-backdrop-open:bg-slate-950/50 hidden size-full fixed top-10 start-10 z-[10000] overflow-x-hidden overflow-y-auto">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all md:max-w-2xl md:w-full m-3 md:mx-auto">
        <div
            class="relative flex flex-col bg-white border shadow-sm rounded-xl overflow-hidden dark:bg-neutral-900 dark:border-neutral-800">
            <div class="absolute top-2 end-2">
                <button type="button"
                    class="closeModalGame flex justify-center items-center size-7 text-sm font-semibold rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-transparent dark:hover:bg-neutral-700"
                    data-hs-overlay="#hs-game-result">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>

            <div>
                
                <div class="p-4 sm:p-10 overflow-y-auto">
                    <div class="mb-6 text-center">
                        <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                            Game Overview
                        </h3>
                        <p class="text-gray-500 dark:text-neutral-500">
                            This is the result of the game and the player's score
                        </p>

                        <div class="bg-white rounded-md p-2 mt-4 grid grid-cols-1 md:grid-cols-3 justify-center items-center">

                            <div id="renderFirstTeam" class="flex justify-center items-center gap-2 shadow">
                               
                            </div>

                            <div class="shadow flex justify-center items-center p-2 uppercase font-bold gap-2">
                                <div class="flex-1 text-center bg-blue-500 text-white">
                                
                                    <span id="fTScore">
                                        100
                                    </span>
                                </div>
                                <div class="font-bold"><h1>Score</h1></div>
                                <div class="flex-1 text-center bg-red-500 text-white">
                                    
                                    <span id="sTScore">
                                       100
                                    </span>
                                </div>
                            </div>

                            <div id="renderSecondTeam" class="flex justify-center items-center gap-2 shadow">

                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- Card Section -->
                <div class="max-w-[85rem] px-4 p-2 -mt-10 sm:px-6 lg:px-8 mx-auto">
                    <div class="mb-5">
                        <h1>Player Score's Overview</h1>
                        <!-- Grid for teams -->
                        <div class="flex justify-center items-center gap-2 border border-slate-500">
                            <div id="renderFPlayerScores" class="flex-1 flex flex-col p-2 text-sm max-h-[170px] overflow-y-auto">
                                
                            </div>
                            <div class="flex">
                                <div class="h-fit p-2 px-4 bg-blue-500 text-white font-bold">V</div>
                                <div class="h-fit p-2 px-4 bg-red-500 text-white font-bold">S</div>
                            </div>
                            <div id="renderSPlayerScores" class="flex-1 flex flex-col items-end p-2 text-sm max-h-[170px] overflow-y-auto">

                            </div>
                        </div>
                        <!-- End Grid for teams -->
                    </div>

                    
                </div>
                <!-- End Card Section -->

                {{-- game end --}}
                <form action="{{ route('admin.sports.game.end') }}" method="post" class="hidden">
                    @csrf
                    <input type="number" name="category_id" id="game_category_id">
                    <button type="submit" id="endGame"></button>
                </form>
            </div>
            <div class="flex justify-end items-center gap-x-2 py-3 px-4 bg-slate-50 border-t">
                    
                <div>
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-red-500 text-white shadow-sm hover:bg-red-700 disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-overlay="#hs-game-result">
                        Cancel
                    </button>
                    <button
                        id="gameCompleted"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none"
                        >
                        End Game
                    </button>
                    {{-- <button
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                        >
                        Print Result
                    </button> --}}
                </div>
            </div>
        </div>
    </div>
</div>
