<!-- Modal Backdrop -->
<div id="editBackdrop" class="fixed inset-0 bg-slate-900 bg-opacity-50 z-9999 hidden"></div>

<!-- Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-99999 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <div class="flex justify-between items-center border-b pb-2">
            <h2 class="text-xl font-semibold">Edit Vote...</h2>
            <button id="editCloseBtn" class="bg-red-500 text-white px-4 py-2 rounded mr-2">Close</button>
        </div>
        <div class="mt-4">
            <div class="flex justify-between items-center text-xl mb-2">
                <p class="">Candidate : <span id="editCandidateName">Name Here</span></p>
                <span id="editCategoryName">Category</span>
            </div>
            <form action="{{ route('judge.update') }}" method="post">
                @csrf
                <input type="number" name="vote_id" id="vote_id" class="hidden">
                <div id="renderEditCriteriaContainer">
                    <div class="flex justify-between items-center font-bold shadow mb-2 p-2">
                        <label for="">Criteria: <span>- 25%</span></label>
                        <input type="number" value="" class="rounded-md">
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-slate-400">AMA TABULATION SYSTEM</span>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-md">Submit Vote</button>
                </div>
            </form>
        </div>
        
    </div>
</div>