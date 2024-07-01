<div class="text-center hidden">
    <button id="openModalPlayerEdit" type="button"
        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
        data-hs-overlay="#hs-player-edit">
        Open modal
    </button>
</div>

<div id="hs-player-edit"
    class="hs-overlay hs-overlay-backdrop-open:bg-slate-950/50 hidden size-full fixed top-10 start-10 z-[100000000] overflow-x-hidden overflow-y-auto">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all md:max-w-xl md:w-full m-3 md:mx-auto">
        <div
            class="relative flex flex-col bg-white border shadow-sm rounded-xl overflow-hidden dark:bg-neutral-900 dark:border-neutral-800">
            <div class="absolute top-2 end-2">
                <button data-hs-overlay="#hs-player-edit" type="button"
                    class="flex justify-center items-center size-7 text-sm font-semibold rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-transparent dark:hover:bg-neutral-700">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('admin.sports.update.player') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="number" name="update_player_id" id="update_player_id" class="hidden">
                <input type="number" name="team_id" id="update_team_id" class="hidden">
                <div class="p-4 sm:p-10 overflow-y-auto">
                    <div class="mb-6 text-center">
                        <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                            Update Player Information
                        </h3>
                        <p class="text-gray-500 dark:text-neutral-500">
                            You can update the information of this player.
                        </p>
                    </div>

                    <div class="space-y-4 mb-2">

                        <div class="flex">
                            <img src="" alt="no image" id="updateProfileDisplay" class="w-[60px] h-[60px]">
                            <input type="file" id="update_player_profile" name="update_player_profile"
                                class="peer py-3 px-4 ps-11 block w-full bg-slate-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Enter name">
                            

                        </div>
                    </div>

                    <div class="space-y-4">

                        <div class="relative">

                            <input type="text" id="update_player_name" name="update_player_name"
                                class="peer py-3 px-4 ps-11 block w-full bg-slate-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Enter name">
                            <div
                                class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                <i
                                    class="fa-solid fa-layer-group text-md flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500"></i>

                            </div>

                        </div>
                    </div>
                </div>



                <div class="flex justify-end items-center gap-x-2 py-3 px-4 bg-slate-50 border-t">
                    <button type="button"
                        class="backButton py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800"
                        data-hs-overlay="#hs-player-edit">
                        Cancel
                    </button>
                    <button
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                        href="#">
                        Update Player
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
