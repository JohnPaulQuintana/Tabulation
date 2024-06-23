
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section'=>auth()->user()->name])
        </div>

            
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 relative">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2">

                <div class="flex justify-between items-center mb-4">
                    {{-- {{ $activeGame }} --}}
                    <h1 class="text-xl"> <span class="bg-slate-700 p-1 text-white">{{ $activeGame->game->sportCategory->event->name }}</span></h1>
                    <h1 class="text-xl"> <span class="p-1 text-slate-800 font-extrabold uppercase">{{ $activeGame->game->sportCategory->category }}</span></h1>
                    <span class="text-orange-500"><i class="fa-solid fa-calendar-clock"></i> On-going</span>
                </div>
                
                <div class="bg-white rounded-md p-2 mt-4 grid grid-cols-1 md:grid-cols-3 justify-center items-center">
                    
                    <div class="flex flex-wrap gap-4 shadow">
                        <img class="w-[70px] h-[70px]" src="{{ asset('storage').'/'.$activeGame->team->profile }}" alt="" srcset="">
                            <div class="font-bold text-start">
                                <h1>{{ $activeGame->team->team_name }}</h1>
                                <h1 class="text-sm">Players : {{ count($activeGame->team->players) }}</h1>
                                <div class="flex gap-2 bg-slate-100 text-sm">
                                    <h1>Win : {{ count($activeGame->team->players) }}</h1>|
                                    <h1>Lose : {{ count($activeGame->team->players) }}</h1>
                                </div>
                            </div>
                    </div>

                    <div class="shadow flex justify-center items-center p-2 uppercase font-bold gap-2">
                        <div class="flex-1 text-center bg-blue-500 text-white">
                            @php
                                $totalScore = 0;
                            @endphp
                            @foreach ($activeGame->team->players as $p)
                                @php
                                    // echo $p;
                                    if(!empty($p->playerTotalScore)){
                                        $totalScore += $p->playerTotalScore->total_score; // Assuming $p->score is the score attribute for each player
                                    }
                                    
                                @endphp                            
                            @endforeach   
                            <span>
                                {{ $totalScore }}
                            </span>
                        </div>
                        <div class="font-bold"><h1>Score</h1></div>
                        <div class="flex-1 text-center bg-red-500 text-white">
                            @php
                                $enemyTotalScore = 0;
                            @endphp
                            @foreach ($enemyTeam->team->players as $ep)
                                @php
                                    // echo $p;
                                    if(!empty($ep->playerTotalScore)){
                                        $enemyTotalScore += $ep->playerTotalScore->total_score; // Assuming $p->score is the score attribute for each player
                                    }
                                    
                                @endphp                            
                            @endforeach   
                            <span>
                                {{ $enemyTotalScore }}
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4 shadow">
                        <div class="font-bold text-end flex-1">
                            <h1>{{ $enemyTeam->team->team_name }}</h1>
                            <h1 class="text-sm">Players : {{ count($enemyTeam->team->players) }}</h1>
                            <div class="flex gap-2 bg-slate-100 justify-end text-sm">
                                <h1>Win : {{ count($activeGame->team->players) }}</h1>|
                                <h1>Lose : {{ count($activeGame->team->players) }}</h1>
                            </div>
                        </div>
                        <img class="w-[70px] h-[70px]" src="{{ asset('storage').'/'.$enemyTeam->team->profile }}" alt="" srcset="">
                       
                    </div>
                   

                </div>

                <div class="bg-white rounded-md p-2 mt-4">
                    <h1>Team Assigned To you.</h1>
                    <div class="flex flex-wrap p-2 gap-2">
                        @foreach ($activeGame->team->players as $key => $p)
                            <div class="shadow group hover:cursor-pointer">
                                <div class="relative overflow-hidden">
                                    <img class="w-30 h-30 transform transition-transform duration-300 ease-in-out group-hover:scale-110" 
                                        src="{{ asset('storage').'/'.$p->profile }}" alt="">
                                    <span class="absolute top-1 left-1 bg-red-500 p-1 rounded-xl text-white font-bold text-sm">
                                        
                                        @if ($key < 10)
                                            0{{ $key+1 }}
                                        @else
                                            {{ $key }}
                                        @endif
                                    </span>
                                   
                                    <a 
                                        data-player_id="{{ $p->id }}" 
                                        data-event_id="{{ $activeGame->event_id }}"
                                        data-team_id="{{ $activeGame->team_id }}"
                                        data-judge_id="{{ $activeGame->judge_id }}"
                                        data-game_id="{{ $activeGame->game_id }}"
                                        href="#" class="absolute scoreNow w-fit h-fit tracking-wide top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-red-500 px-4 py-2 rounded-xl text-white font-bold text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">
                                        Score
                                    </a>
                                
                                    
                                </div>
                                <div class="flex flex-col max-w-30 text-center text-sm">
                                    <span class="font-bold">{{ $p->name }}</span>
                                   
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('judge.sports.score.score')
    {{-- @include('judge.vote.edit') --}}
    @section('scripts')
    
        <script>
            let error = @json(session('error'));
            let success = @json(session('success'));
            let playerScores = @json($activeGame->team->players);
            console.log(playerScores)
            $(document).ready(function(){
                if(error){
                    sweetAlert('Score Error!','Score is required!','error')
                }else if(success){
                    sweetAlert('Score Saved!','Score is successfully saved!','success')
                }
              $('.scoreNow').click(function(){
                    let gid = $(this).data('game_id')
                    let tid = $(this).data('team_id')
                    let eid = $(this).data('event_id')
                    let jid = $(this).data('judge_id')
                    let pid = $(this).data('player_id')

                    $('#score_game_id').val(gid)
                    $('#score_team_id').val(tid)
                    $('#score_event_id').val(eid)
                    $('#score_judge_id').val(jid)
                    $('#score_player_id').val(pid)
                    playerTotalScore(playerScores,pid);
                    $('#scoreModalBtn').trigger('click')
              })

              

            })

            //get the player total score
            const playerTotalScore = (pScore,id) => {
                pScore.forEach(ts => {
                    console.log(ts.player_total_score)
                    if(ts.player_total_score != null){
                        if(ts.player_total_score.player_id == parseInt(id)){
                        // console.log(ts.player_total_score.total_score)
                        //  ts.player_total_score.total_score;
                            $('#player_total_score').val(ts.player_total_score.total_score);
                            $('#total_score_id').val(ts.player_total_score.id)
                        }
                    }else{
                        $('#player_total_score').attr('readonly', true)
                    }
                    
                    
                });
            }
            
            const sweetAlert = (t,m,i) => {
                Swal.fire({
                    title: t,
                    text: m,
                    icon: i,
                    timer: 2000,  // Close after 2 seconds (2000 milliseconds)
                    showConfirmButton: false  // Hide the confirmation button
                });

            }

        </script>
    @endsection
</x-app-layout>


