<div class="text-center hidden">
    <button id="completedModalGame" type="button"
        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
        data-hs-overlay="#hs-completed">
        Open modal
    </button>
</div>

<div id="hs-completed"
    class="hs-overlay hs-overlay-backdrop-open:bg-slate-950/50 hidden size-full fixed top-10 start-10 z-[1000] overflow-x-hidden overflow-y-auto">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all md:max-w-2xl md:w-full m-3 md:mx-auto">
        <div
            class="relative flex flex-col bg-white border shadow-sm rounded-xl overflow-hidden dark:bg-neutral-900 dark:border-neutral-800">
            <div class="absolute top-2 end-2">
                <button type="button"
                    class="closeModalGame flex justify-center items-center size-7 text-sm font-semibold rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-transparent dark:hover:bg-neutral-700"
                    data-hs-overlay="#hs-completed">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-2">
                
                <div class="p-4 sm:p-10 overflow-y-auto">
                    <div class="mb-6 text-center">
                        <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                            Completed Game Result
                        </h3>
                        <p class="text-gray-500 dark:text-neutral-500">
                            This is the completed game result available for viewing
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2" id="renderGameResults">

                    <div class="shadow p-2 flex flex-col items-center justify-center">
                        <div class="font-bold text-green-500 uppercase">
                            <h1>Category</h1>
                        </div>
                        <div class="flex justify-center items-center gap-4 w-full">
                            <div class="border rounded-md flex-1 text-center">
                                Team-1
                                <span class="block text-green-500">win</span>
                            </div>
                            <div class="font-bold">VS</div>
                            <div class="border rounded-md flex-1 text-center">
                                Team-2
                                <span class="block text-red-500">lose</span>
                            </div>
                        </div>
                    </div>
                   
                </div>

                
            </div>

            <div class="flex justify-end items-center gap-x-2 py-3 px-4 bg-slate-50 border-t">
                    
                <div>
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-red-500 text-white shadow-sm hover:bg-red-700 disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-overlay="#hs-completed">
                        Cancel
                    </button>
                    
                </div>
            </div>

        </div>
    </div>
</div>
