<div class="text-center hidden">
    <button id="openModalCategory" type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-category">
      Open modal
    </button>
  </div>
  
  <div id="hs-category" class="hs-overlay hs-overlay-backdrop-open:bg-slate-950/50 hidden size-full fixed top-10 start-10 z-[100000000] overflow-x-hidden overflow-y-auto">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all md:max-w-2xl md:w-full m-3 md:mx-auto">
      <div class="relative flex flex-col bg-white border shadow-sm rounded-xl overflow-hidden dark:bg-neutral-900 dark:border-neutral-800">
        <div class="absolute top-2 end-2">
          <button type="button" class="closeModalCategory flex justify-center items-center size-7 text-sm font-semibold rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-transparent dark:hover:bg-neutral-700" data-hs-overlay="#hs-category">
            <span class="sr-only">Close</span>
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          </button>
        </div>
  
        <form action="{{ route('admin.sports.category') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="number" name="event_id" id="category_event_id" class="hidden">
            <div class="p-4 sm:p-10 overflow-y-auto">
            <div class="mb-6 text-center">
                <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                  Category of Sport's
                </h3>
                <p class="text-gray-500 dark:text-neutral-500">
                  Add a new category for sport's.
                </p>
            </div>
    
            <div class="space-y-4">
              
                <div class="relative">
                    
                    <input type="text" name="category" class="peer py-3 px-4 ps-11 block w-full bg-slate-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Enter name">
                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                      <i class="fa-solid fa-layer-group text-md flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500"></i>
                    {{-- <svg class="flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg> --}}
                    </div>
                    {{-- @error('category') --}}
                    
                    {{-- @enderror --}}
                </div>
                <span id="category_error" class="text-red-500 hidden">Category is required, Temporarily disabled the created category display!</span>
            </div>
            </div>

            <!-- Card Section -->
            <div class="max-w-[85rem] px-4 p-2 -mt-5 sm:px-6 lg:px-8 mx-auto">
              <h1>Created Category : click the category to enable editing</h1>
              <!-- Grid -->
              <div id="renderCategories" class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-3 sm:gap-6 shadow p-2">
                <!-- Card -->
                <a class="group flex flex-col bg-white border shadow-sm rounded-md hover:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800" href="#">
                  <div class="p-2 md:p-2">
                    <div class="flex justify-between items-center">
                      <div class="flex items-center">
                        <i class="fa-solid fa-layer-group text-2xl"></i>
                        <div class="ms-3">
                          <h4 class="group-hover:text-blue-600 text-sm font-semibold text-gray-800 dark:group-hover:text-neutral-400 dark:text-neutral-200">
                            Sample Teams
                          </h4>
                        </div>
                      </div>
                      {{-- <div class="ps-3">
                        <svg class="flex-shrink-0 size-5 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                      </div> --}}
                    </div>
                  </div>
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
                  Save Category
              </button>
            </div>
        </form>
        
      </div>
    </div>
  </div>