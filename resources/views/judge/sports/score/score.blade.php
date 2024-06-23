<div class="text-center">
    <button id="scoreModalBtn" type="button" class="py-3 px-4 hidden inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-score">
      Open modal
    </button>
  </div>
  
  <div id="hs-score" class="hs-overlay hs-overlay-backdrop-open:bg-slate-950/50 hidden size-full fixed top-10 start-10 z-[1000] overflow-x-hidden overflow-y-auto">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
      <div class="relative flex flex-col bg-white border shadow-sm rounded-xl overflow-hidden dark:bg-neutral-900 dark:border-neutral-800">
        <div class="absolute top-2 end-2">
          <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-transparent dark:hover:bg-neutral-700" data-hs-overlay="#hs-score">
            <span class="sr-only">Close</span>
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          </button>
        </div>
  
        <div class="p-4 sm:p-10 overflow-y-auto">
          <div class="mb-6 text-center">
            <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
              Add Score
            </h3>
            <p class="text-gray-500 dark:text-neutral-500">
              Scores to a player
            </p>
          </div>
  
          <div class="space-y-4">

            <form action="{{ route('judge.sports.player.score') }}" method="post">
                @csrf
                <input type="number" name="game_id" id="score_game_id" class="hidden">
                <input type="number" name="team_id" id="score_team_id" class="hidden">
                <input type="number" name="event_id" id="score_event_id" class="hidden">
                <input type="number" name="judge_id" id="score_judge_id" class="hidden">
                <input type="number" name="player_id" id="score_player_id" class="hidden">
                <div class="relative">
                    <input type="number" name="score" min="1" max="1000" class="peer py-3 px-4 ps-11 block w-full bg-slate-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Enter player score">
                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        <i class="fa-solid fa-star flex-shrink-0 size-4 text-gray-500"></i>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-x-2 px-4 mt-2 bg-gray-50">
                    
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                      Save Scores
                    </button>
                </div>
            </form>
            
          </div>

          <div class="space-y-4 shadow rounded-md p-2 mt-2">
                <h1 class="font-bold">Player Score <span class="text-sm">(total)</span></h1>
                <form action="{{ route('judge.sports.player.score.update') }}" method="post">
                    @csrf
                    <input id="total_score_id" type="number" name="total_score_id" class="hidden peer py-3 px-4 ps-11 block w-full bg-slate-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Enter player score">
                    <div class="relative">
                      <input id="player_total_score" type="number" name="player_total_score" min="1" max="1000" class="peer py-3 px-4 ps-11 block w-full bg-slate-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Enter player score">
                      <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                          <i class="fa-solid fa-star flex-shrink-0 size-4 text-gray-500"></i>
                      </div>
                  </div>
                  <span>To edit Substract/Add the score on total.</span>
                  <div class="flex justify-end items-center gap-x-2 px-4 bg-gray-50">
                      <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800" data-hs-overlay="#hs-score">
                        Cancel
                      </button>
                      <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                        Update Scores
                      </button>
                  </div>
                </form>
          </div>
        </div>
  
        
      </div>
    </div>
  </div>