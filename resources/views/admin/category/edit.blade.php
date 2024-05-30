<!-- Modal Backdrop -->
<div id="editBackdrop" class="fixed inset-0 bg-slate-900 bg-opacity-50 z-9999 hidden"></div>

<!-- Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-99999 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <div class="flex justify-between items-center border-b pb-2">
            <h2 class="text-xl font-semibold">Edit Category...</h2>
            <button id="editCloseBtn" class="bg-red-500 text-white px-4 py-2 rounded mr-2">Close</button>
        </div>
        <div class="mt-4">
            <div class="flex justify-between items-center text-xl mb-2">
                {{-- <p class="">Category : <span id="editCategoryName">Name Here</span></p> --}}
                {{-- <span id="editCategoryName">Category</span> --}}
            </div>
            <form action="{{ route('admin.category.update') }}" method="post">
                @csrf
                <input type="number" name="category_id" id="category_id" class="hidden">
                <div>
                    <div class="flex flex-col shadow mb-2 p-2">
                        <label for="">Name:</label>
                        <input type="text" id="category_name" name="category_name" value="" class="rounded-md">
                    </div>
                    <div id="renderEditCriteriaContainer" class="flex flex-col gap-2 justify-between items-center shadow mb-2 p-2">
                        <div class="flex gap-2 justify-between items-center shadow mb-2 p-2">
                            <div class="">
                                <label for="">Criteria:</label>
                                <input type="text" name="criteria[]" value="" class="rounded-md w-full">
                            </div>
                            
                            <div class="">
                                <label for="">Percentage:</label>
                                <input type="number" name="percentage[]" value="" class="rounded-md w-full">
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-slate-400">AMA TABULATION SYSTEM</span>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-md">Save Category</button>
                </div>
            </form>
        </div>
        
    </div>
</div>