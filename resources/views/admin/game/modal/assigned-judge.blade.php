<div class="text-center hidden">
    <button id="assignedJudgeModalGame" type="button"
        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
        data-hs-overlay="#hs-assigned-judge">
        Open modal
    </button>
</div>

<div id="hs-assigned-judge"
    class="hs-overlay hs-overlay-backdrop-open:bg-slate-950/50 hidden size-full fixed top-10 start-10 z-[1000] overflow-x-hidden overflow-y-auto">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all md:max-w-2xl md:w-full m-3 md:mx-auto">
        <div
            class="relative flex flex-col bg-white border shadow-sm rounded-xl overflow-hidden dark:bg-neutral-900 dark:border-neutral-800">
            <div class="absolute top-2 end-2">
                <button type="button"
                    class="closeModalGame flex justify-center items-center size-7 text-sm font-semibold rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-transparent dark:hover:bg-neutral-700"
                    data-hs-overlay="#hs-assigned-judge">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('admin.sports.judge.selected') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="number" name="game_id" id="assigned_gameId" class="hidden">
                <input type="number" name="event_id" id="assigned_eventId" class="hidden">
                <input type="number" name="team_id" id="assigned_teamId" class="hidden">
                <div class="p-4 sm:p-10 overflow-y-auto">
                    <div class="mb-6 text-center">
                        <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                            Assigned a judge
                        </h3>
                        <p class="text-gray-500 dark:text-neutral-500">
                            The judge is responisble for scoring for each player's.
                        </p>
                    </div>
                </div>

                <!-- Card Section -->
                <div class="max-w-[85rem] px-4 p-2 -mt-10 sm:px-6 lg:px-8 mx-auto">
                    <div class="mb-5">
                        <h1>Selection of Judge : Click the Judge Profile</h1>
                        <!-- Grid for teams -->
                        <div
                            class="renderJudgeTeams grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-3 shadow p-2">
                            <!-- Card -->
                            <a class="group flex flex-col bg-white shadow-sm rounded-xl hover:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800"
                                href="#">
                                <label
                                    class="flex items-center gap-2 p-3 w-full bg-slate-100 border border-slate-100 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 group-hover:cursor-pointer">
                                    <input type="checkbox" name="selectedTeams[]" value="1"
                                        class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                    <div class="flex items-center gap-1">
                                        <img class="w-[50px]"
                                            src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=900&h=900&q=80"
                                            alt="">
                                        <span class="font-bold">Team 1 Name</span>
                                    </div>
                                </label>

                            </a>
                            <!-- End Card -->
                        </div>
                        <!-- End Grid for teams -->
                    </div>

                    
                </div>
                <!-- End Card Section -->

                <div class="flex justify-end items-center gap-x-2 py-3 px-4 bg-slate-50 border-t">
                    
                    <div>
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-red-500 text-white shadow-sm hover:bg-red-700 disabled:opacity-50 disabled:pointer-events-none"
                            data-hs-overlay="#hs-assigned-judge">
                            Cancel
                        </button>
                        <button
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            >
                            Asign Judge
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
