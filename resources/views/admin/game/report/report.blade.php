<div class="text-center hidden">
    <button id="openModalTeamReport" type="button"
        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
        data-hs-overlay="#hs-teamReport">
        Open modal
    </button>
</div>

<div id="hs-teamReport"
    class="hs-overlay hs-overlay-backdrop-open:bg-slate-950/50 hidden size-full fixed top-10 start-10 z-[100000000] overflow-x-hidden overflow-y-auto">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all md:max-w-2xl md:w-full m-3 md:mx-auto">
        <div
            class="relative flex flex-col bg-white border shadow-sm rounded-xl overflow-hidden dark:bg-neutral-900 dark:border-neutral-800">
            <div class="absolute top-2 end-2">
                <button type="button"
                    class="closeModalTeams flex justify-center items-center size-7 text-sm font-semibold rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-transparent dark:hover:bg-neutral-700"
                    data-hs-overlay="#hs-teamReport">
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

                <div id="contents" class="p-4 sm:p-10 overflow-y-auto">

                    <div class="mb-6 text-center">
                        <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                            Game Result for <span id="cTitle" class="font-bold"></span>
                        </h3>
                        <p class="text-gray-500 dark:text-neutral-500">
                            This is the result on category.
                           
                        </p>
                        <span class="block">Date and Time : {{ now() }}</span>
                    </div>

                    <div
                        class="bg-white rounded-md p-2 mt-4 grid grid-cols-3 justify-center items-center">

                        <div id="cTeam1" class="flex justify-center items-center gap-2 shadow">
                            
                        </div>

                        <div class="shadow flex justify-center items-center p-2 uppercase font-bold gap-2">
                            <div class="flex-1 text-center bg-blue-500 text-white">

                                <span id="totalFScore">
                                    100
                                </span>
                            </div>
                            <div class="font-bold">
                                <h1>Score</h1>
                            </div>
                            <div class="flex-1 text-center bg-red-500 text-white">

                                <span id="totalSScore">
                                    100
                                </span>
                            </div>
                        </div>

                        <div id="cTeam2" class="flex justify-center items-center gap-2 shadow">
                            
                        </div>

                    </div>

                    <div class="bg-slate-100 rounded-sm p-2 grid grid-cols-2 gap-1 overflow-y-auto md:h-[200px]">
                        <div class="text-start">
                            <h1 class="text-blue-500">Player Scores</h1>
                            <div id="cTeam1Players" class="">
                                
                            </div>
                        </div>
                        <div class="text-end">
                            <h1 class="text-red-500">Player Scores</h1>
                            <div id="cTeam2Players" class="">
                                
                            </div>
                        </div>
                    </div>

                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 bg-slate-50 border-t">
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800"
                        data-hs-overlay="#hs-completed">
                        Cancel
                    </button>
                    <button
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                        href="#" id="PrintDivBtn">
                        Print Result
                    </button>
                </div>
            </div>
        </div>
    </div>
