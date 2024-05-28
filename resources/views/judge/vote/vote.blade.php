<!-- Modal Backdrop -->
<div id="voteBackdrop" class="fixed inset-0 bg-slate-900 bg-opacity-50 z-9999"></div>

<!-- Modal -->
<div id="voteModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-99999">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <div class="flex justify-between items-center border-b pb-2">
            <h2 class="text-xl font-semibold">Start Voting...</h2>
            <button id="voteCloseBtn" class="bg-red-500 text-white px-4 py-2 rounded mr-2">Close</button>
        </div>
        <div class="mt-4">
            <div class="flex justify-between items-center text-xl">
                <p class="mb-2">Candidate : <span>Name Here</span></p>
                <span>Category</span>
            </div>
            <form action="#" method="post">
                @csrf
                <div id="renderCategory">
                    <label for=""></label>
                </div>
            </form>
        </div>
        
    </div>
</div>