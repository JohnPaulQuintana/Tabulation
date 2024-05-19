<!-- Modal Backdrop -->
<div id="judgeBackdrop" class="fixed inset-0 bg-slate-900 bg-opacity-50 z-9999"></div>

<!-- Modal -->
<div id="judgeModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-99999">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <div class="flex justify-between items-center border-b pb-2">
            <h2 class="text-xl font-semibold">New Judge Created Successfully</h2>
            <i class="fa-sharp fa-solid fa-circle-check text-green-500"></i>
        </div>
        <div class="mt-4">
            <p class="text-red-500 mb-1">System Message</p>
            <p class="text-gray-700 bg-slate-50 p-2 mb-1">
                <span class="text-slate-500 text-md">A new judge has been successfully added to the event.</span>
            </p>
            
        </div>
        <div class="mt-6 flex justify-end">
            <button id="judgeCloseBtn" class="bg-red-500 text-white px-4 py-2 rounded mr-2">Close</button>
        </div>
    </div>
</div>