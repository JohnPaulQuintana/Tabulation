<!-- Modal Backdrop -->
<div id="codeBackdrop" class="fixed inset-0 bg-slate-900 bg-opacity-50 z-9999 hidden"></div>

<!-- Modal -->
<div id="codeModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-99999 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-[50%]">
        <div class="flex justify-between items-center border-b pb-2">
            <h2 class="text-xl font-semibold">CODE</h2>
            <i class="fa-solid fa-print"></i>
        </div>
        
        <div id="code-container" class="bg-white">
            <h1 class="text-center font-bold p-2 tracking-wider text-xl uppercase">Generated Judge Code</h1>
            <div id="renderCode" class="mt-4 grid grid-cols-2 gap-4">

                
                
            </div>
            
        </div>
        <div class="mt-6 flex justify-end">
            <button id="printCancelBtn" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded mr-2">Cancel</button>
            <button id="printBtn" onclick="PrintDiv()" class="bg-slate-700 hover:bg-slate-800 text-white px-4 py-2 rounded mr-2">Print Code</button>
        </div>
    </div>
</div>