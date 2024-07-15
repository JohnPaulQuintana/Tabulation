<div class="text-center hidden">
    <button id="activateModalBtn" type="button"
        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
        data-hs-overlay="#hs-activate-candidate">
        Open modal
    </button>
</div>

<div id="hs-activate-candidate"
    class="hs-overlay hs-overlay-backdrop-open:bg-slate-950/50 hidden size-full fixed top-10 start-10 z-[10000] overflow-x-hidden overflow-y-auto">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all md:max-w-4xl md:w-full m-3 md:mx-auto">
        <div
            class="relative flex flex-col bg-white border shadow-sm rounded-xl overflow-hidden dark:bg-neutral-900 dark:border-neutral-800">
            <div class="absolute top-2 end-2">
                <button type="button"
                    class="closeModalGame flex justify-center items-center size-7 text-sm font-semibold rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-transparent dark:hover:bg-neutral-700"
                    data-hs-overlay="#hs-activate-candidate">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>

            <div id="contents">
                
                <div class="p-4 sm:p-10 overflow-y-auto">
                    <div class="mb-6 text-center sm:bg-green-500 sm:text-white">
                        <h3 class="mb-2 text-2xl font-bold text-gray-800 dark:text-neutral-200">
                            Candidate's
                        </h3>

                        <span>Date and Time: {{ now()->format('F j, Y, g:i A') }}</span>

                    </div>
                </div>

                <!-- Card Section -->
                <div class="max-w-[85rem] px-4 p-2 -mt-10 sm:px-6 lg:px-8 mx-auto overflow-y-auto mb-4">
                    <div class="mb-5">
                        <h1 class="text-slate-500 font-bold">Start Activating Candidate's for <span class="">Voting</span></h1>
                       {{-- @for ($i = 0; $i < 5; $i++) --}}
                            <!-- flex for judges -->
                        <div class="flex gap-2 p-2 flex-wrap items-center border py-2 bg-slate-100" id="renderDeactivated">
                            
                        </div>
                        <!-- End flex for judges -->
                       {{-- @endfor --}}
                    </div>

                    
                </div>
                <!-- End Card Section -->
                
            </div>
            <div class="flex justify-end items-center gap-x-2 py-3 px-4 bg-slate-50 border-t">
                    
                <div>
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-red-500 text-white shadow-sm hover:bg-red-700 disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-overlay="#hs-activate-candidate">
                        Cancel
                    </button>
                    
                </div>
            </div>
        </div>
    </div>
</div>
