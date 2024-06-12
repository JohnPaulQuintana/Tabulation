<div class="text-center hidden">
    <button id="openModalGame" type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-game">
      Open modal
    </button>
  </div>
  
  <div id="hs-game" class="hs-overlay hs-overlay-backdrop-open:bg-slate-950/50 hidden size-full fixed top-10 start-10 z-[100000000] overflow-x-hidden overflow-y-auto">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all md:max-w-2xl md:w-full m-3 md:mx-auto">
      <div class="relative flex flex-col bg-white border shadow-sm rounded-xl overflow-hidden dark:bg-neutral-900 dark:border-neutral-800">
        <div class="absolute top-2 end-2">
          <button type="button" class="closeModalGame flex justify-center items-center size-7 text-sm font-semibold rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-transparent dark:hover:bg-neutral-700" data-hs-overlay="#hs-game">
            <span class="sr-only">Close</span>
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          </button>
        </div>
  
        <form action="{{ route('admin.sports.store.team') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="number" name="category_id" id="category_id" class="hidden">
            <div class="p-4 sm:p-10 overflow-y-auto">
              <div class="mb-6 text-center">
                  <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                    Selection of Team to Battle
                  </h3>
                  <p class="text-gray-500 dark:text-neutral-500">
                    Select team 1 and team 2 to battle.
                  </p>
              </div>
            </div>

            <!-- Card Section -->
            <div class="max-w-[85rem] px-4 p-2 -mt-10 sm:px-6 lg:px-8 mx-auto">
              <h1>Selection Teams : Click the Team Profile</h1>
              <!-- Grid -->
              <div id="renderTeams" class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-3 sm:gap-6 shadow p-2">
                <!-- Card -->
                <a class="group flex flex-col bg-white shadow-sm rounded-xl hover:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800" href="#">
                  <label class="flex items-center gap-2 p-3 w-full bg-slate-100 border border-slate-100 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 group-hover:cursor-pointer">
                    <input type="checkbox" name="selectedTeams[]" value="1" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                    <div class="flex items-center gap-1">
                      <img class="w-[50px]" src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=900&h=900&q=80" alt="">
                      <span class="font-bold">Team 1 Name</span>
                    </div>
                  </label>
                  
                </a>
                <!-- End Card -->
              </div>
              <!-- End Grid -->
            </div>
            <!-- End Card Section -->
    
            <div class="flex justify-end items-center gap-x-2 py-3 px-4 bg-slate-50 border-t">
            {{-- <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800" data-hs-overlay="#hs-notifications">
                Cancel
            </button> --}}
              <button class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                  Start the Game
              </button>
            </div>
        </form>
        
      </div>
    </div>
  </div>