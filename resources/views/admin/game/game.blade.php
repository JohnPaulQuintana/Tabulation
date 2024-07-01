<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section' => 'Game Section'])
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 px-6 text-gray-900 dark:text-gray-100">
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to sport section, where the game started!
                        {{ auth()->user()->name }}</span>
                </div>
            </div>
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mt-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="flex justify-between items-center w-full p-2">
                    <p class="w-full font-bold">Selected Sports</p>
                    <div>


                        <button id="dropdownRadioBgHoverButton" data-dropdown-toggle="dropdownRadioBgHover"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">Status <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownRadioBgHover"
                            class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownRadioBgHoverButton">
                                <li>
                                    <form action="{{ route('admin.event.setStatus') }}" method="POST">
                                        <input type="number" name="event_id" value="{{ $sport->id }}"
                                            class="hidden">
                                        @csrf
                                        <div
                                            class="flex items-center p-2 rounded hover:bg-slate-100 hover:cursor-pointer">
                                            <input @if ($sport->status === 0) checked @endif id="default-radio-4"
                                                type="radio" value="0" name="set_status"
                                                onchange="this.form.submit()"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 hover:cursor-pointer">
                                            <label for="default-radio-4"
                                                class="w-full ms-2 text-sm font-medium text-red-500 rounded hover:cursor-pointer">Offline</label>
                                        </div>
                                        <div
                                            class="flex items-center p-2 rounded hover:bg-slate-100 hover:cursor-pointer">
                                            <input @if ($sport->status === 1) checked @endif id="default-radio-5"
                                                type="radio" value="1" name="set_status"
                                                onchange="this.form.submit()"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 hover:cursor-pointer">
                                            <label for="default-radio-5"
                                                class="w-full ms-2 text-sm font-medium text-blue-500 rounded dark:text-gray-300 hover:cursor-pointer">Online</label>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>



                    </div>
                </div>

                <div class="p-2 text-gray-900 grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-2">

                    <div class="shadow p-2 flex gap-1">
                        <img class="w-[100px]" src="{{ asset('storage') . '/' . $sport->image }}" alt="">
                        <div class="">
                            <h1 class="font-bold">{{ $sport->name }}</h1>
                            <p class="text-sm">{{ $sport->details }}</p>
                        </div>
                    </div>

                    <div class="shadow p-2 flex gap-1">
                        <i class="fa-solid fa-users-viewfinder text-5xl mr-2"></i>
                        <div class="text-center">
                            <h1 class="font-bold">Total of Judge's</h1>
                            <p class="text-md font-bold">{{ count($sport->judge) }}</p>
                        </div>
                    </div>

                    <div class="shadow p-2 flex gap-1">
                        <i class="fa-solid fa-people-group text-5xl mr-2"></i>
                        <div class="text-center">
                            <h1 class="font-bold">Total of Team's</h1>
                            <p class="text-md font-bold">{{ count($sport->teams) }}</p>
                        </div>
                    </div>

                    <div class="shadow p-2 flex gap-1">
                        <i class="fa-solid fa-layer-group text-5xl mr-2"></i>
                        <div class="text-center">
                            <h1 class="font-bold">Total of Categories</h1>
                            <p class="text-md font-bold">{{ count($sport->sportsCategories) }}</p>
                        </div>
                    </div>

                </div>

                {{-- in game setting --}}

                <div class="p-2 text-gray-900">
                    @include('admin.game.tables.game', ['inGames' => $inGame])
                </div>

            </div>
        </div>
    </div>

    @include('admin.game.modal.game-setup')
    @include('admin.game.modal.change-team')
    @include('admin.game.modal.assigned-judge')
    @include('admin.game.modal.result')
    @include('admin.game.modal.completed')
    @include('admin.game.report.report')

    @section('scripts')
        <script>
            let teams = @json($sport->teams);
            let judges = @json($sport->judge);
            let fTeam = @json($firstTeam);
            let sTeam = @json($secondTeam);
            console.log(fTeam)
            let categories = @json($sport->sportsCategories);
            // console.log()
            let modal = @json(session('modal'));
            let modalChange = @json(session('modalChange'));
            let modalJudge = @json(session('modalJudge'));
            let game = @json(session('game'));
            let status = @json(session('status'));
            let sessionCategoryId = @json(session('category_id'));
            let sessionEventId = @json(session('event_id'));

            let gameResults = @json($teamGameResultsCount);

            //for printing
            let printCategoryResults = @json($printCategoryResults);
            // console.log(printCategoryResults)
            // console.log(gameResults)

            // console.log('conected')
            $(document).ready(function() {
                //for debug
                // console.log(modalChange)
                // $('#openModalTeamReport').trigger('click')

                if (modal) {
                    renderTeams(teams)
                    renderCategories(categories)
                    $('#setupModalGame').trigger('click')
                    success('Teams and Category', '2 team and 1 category is required to start the match!', 'error');

                } else if (modalChange) {
                    success('Team is required!', 'Please select a team.', 'error');
                } else if (modalJudge) {
                    success('Judge is required!', 'Please select a judge.', 'error');
                } else if (status) {
                    success('Matched Successfully.', 'the matched is set successfully.', 'success')
                } else if (game === false) {
                    success('Matched is saved.', 'available at game completed action button.', 'success');
                }

                //setup the game
                $(".setPlayerAndCategory").click(function() {
                    // alert('it is')
                    renderTeams(teams)
                    renderCategories(categories)
                    $('#setupModalGame').trigger('click')
                })

                //change the palyer
                $('.gameBtn').click(function() {
                    // alert($(this).data('game_id'))
                    let eventID = $(this).data('event_id');
                    let gameID = $(this).data('game_id');
                    let teamID = $(this).data('team_id');
                    $('#gameId').val(gameID)
                    $('#eventId').val(eventID)
                    changeTeams(teams, teamID)
                    $('#changeModalGame').trigger('click')
                })

                //asigned judge
                $('.judgeBtn').click(function() {
                    let eventID = $(this).data('event_id');
                    let gameID = $(this).data('game_id');
                    let teamID = $(this).data('team_id');
                    let scorerID = $(this).data('scorer_id');
                    // alert(scorerID)
                    $('#assigned_gameId').val(gameID)
                    $('#assigned_eventId').val(eventID)
                    $('#assigned_teamId').val(teamID)

                    renderJudges(judges, scorerID)
                    $('#assignedJudgeModalGame').trigger('click')
                })

                //game result
                $('#gameResult').click(function() {
                    let activeGame = $(this).data('active_game')
                    //setup the category active 
                    $('#game_category_id').val(activeGame)
                    // alert(activeGame)
                    renderFirstTeam(fTeam);
                    renderSecondTeam(sTeam);
                    $('#resultModalGame').trigger('click')
                })

                //game completed
                $('#gameCompleted').click(function() {
                    $('#endGame').trigger('click')
                })

                //show completed game
                $('#completedGame').click(function() {
                    // alert('yes');
                    renderGames(gameResults, teams)
                    $('#completedModalGame').trigger('click')
                })

                //print
                $('#PrintDivBtn').click(function(){
                    PrintDiv()
                })

            })

            

            const renderGames = (results, teams) => {
                // console.log(teams);
                let renderResults = '';

                results.forEach(c => {
                    // Initialize objects for the two teams
                    let team1 = {
                        name: '',
                        result: ''
                    };
                    let team2 = {
                        name: '',
                        result: ''
                    };

                    // console.log(c);

                    teams.forEach(t => {
                        if (t.id == c.game_results[0].team_id) {
                            // console.log(t);
                            team1.name = t.team_name;
                            team1.result = c.game_results[0].result;
                        }
                        if (t.id == c.game_results[1].team_id) {
                            // console.log(t);
                            team2.name = t.team_name;
                            team2.result = c.game_results[1].result;
                        }
                    });

                    renderResults += `
                        <div class="shadow p-2 grid grid-cols-1 items-center bg-slate-100">
                            <div class="col-span-2 font-bold text-green-500 uppercase text-center">
                                <h1>${c.category}</h1>
                            </div>
                            <div class="col-span-2 flex items-center gap-4 w-full">
                                <div class="rounded-md flex-1 text-center text-sm bg-white py-2">
                                    ${team1.name}
                                    <span class="block ${team1.result == 'win' ? 'text-green-500' : 'text-red-500'} uppercase">${team1.result}</span>
                                </div>
                                <div class="font-bold">VS</div>
                                <div class="rounded-md flex-1 text-center text-sm bg-white py-2">
                                    ${team2.name}
                                    <span class="block ${team2.result == 'win' ? 'text-green-500' : 'text-red-500'} uppercase">${team2.result}</span>
                                </div>
                            </div>
                            <div data-category_id="${c.id}" class="printGameResultBtn bg-green-500 p-1 w-full rounded-md text-center text-white mt-2 hover:bg-green-700 hover:cursor-pointer">
                                <button><i class="fa-solid fa-print hover:text-slate-900 hover:cursor-pointer"></i> Print Result</button>    
                            </div>
                        </div>
                    `;
                });

                $('#renderGameResults').html(renderResults);

                //click the print result
                $('.printGameResultBtn').click(function(){
                    // alert($(this).data('category_id'))
                    let categoryID = $(this).data('category_id')
                    $('#openModalTeamReport').trigger('click')
                    printing(printCategoryResults, categoryID);
                })
            };

            //for printing
            const printing = (categoryResult, id) => {
                // console.log(categoryResult, id)
                let renderTeam1Player = ''
                let renderTeam2Player = ''
                let path = "{{ asset('storage') }}"
                categoryResult.forEach(c => {
                    console.log(c.id, id)
                    if(c.id === id){
                        // console.log(c)
                        $('#cTitle').text(c.category)
                        $('#cTeam1').html(`
                            <img class="w-[60px] h-[60px]" src="${path}/${c.game_results[0].team.profile}"
                                alt="" srcset="">
                            <div class="font-bold text-start">
                                <span class="text-[12px] p-0">${c.game_results[0].team.team_name}</span>
                                <span class="text-[12px] p-0 block">Players : ${c.game_results[0].team.players.length}</span>
                                
                            </div>
                        `)
                        $('#cTeam2').html(`
                            
                            <div class="font-bold text-end">
                                <span class="text-[12px] p-0">${c.game_results[1].team.team_name}</span>
                                <span class="text-[12px] p-0 block">Players : ${c.game_results[1].team.players.length}</span>
                                
                            </div>
                            <img class="w-[60px] h-[60px]" src="${path}/${c.game_results[1].team.profile}"
                                alt="" srcset="">
                        `)

                        //render Team player 1 
                        let totalFScore = 0;
                        let totalSScore = 0;
                        c.game_results[0].team.players.forEach(p => {
                            console.log(c.game_results[0])
                            p.player_score.forEach(score => {
                                console.log(score.game_id)
                                if(score.game_id === c.game_results[0].id){
                                    totalFScore += parseInt(score.score);
                                    renderTeam1Player += `
                                        <div class="flex gap-1 items-center gap-2 mb-1 bg-white p-1 rounded-md">
                                                <img class="w-[30px] h-[30px] rounded-xl" src="${path}/${p.profile}"
                                                alt="" srcset="">
                                                <span>${p.name}</span>
                                                <span>: ${score.score}</span>
                                            </div>
                                        `
                                }
                            });
                            
                        });
                        //render Team player 2 
                        c.game_results[1].team.players.forEach(p => {
                            // console.log(p)
                            p.player_score.forEach(score => {
                                if(score.game_id === c.game_results[1].id){
                                    totalSScore += parseInt(score.score);
                                    renderTeam2Player += `
                                        <div class="flex gap-2 justify-end items-center mb-1 bg-white p-1 rounded-md">
                                                <span>${score.score} :</span>
                                                <span>${p.name}</span>
                                                <img class="w-[30px] h-[30px] rounded-xl" src="${path}/${p.profile}"
                                                alt="" srcset="">
                                            </div>
                                        `
                                }
                            })
                            
                        });

                        $('#totalFScore').text(totalFScore);
                        $('#totalSScore').text(totalSScore);
                        $('#cTeam1Players').html(renderTeam1Player)
                        $('#cTeam2Players').html(renderTeam2Player)
                    }
                });
            }

            const renderFirstTeam = (f) => {
                let first = ''
                let totalFScore = 0;
                let fPlayerScore = '';
                let firstProfile = "{{ asset('storage') }}"
                // Check if game_result and game_result[0] are defined and provide default values if not
                const totalWins = (f.game_result && f.game_result[0] && f.game_result[0].totalWins) || 0;
                const totalLoss = (f.game_result && f.game_result[0] && f.game_result[0].totalLoss) || 0;

                first = `
                        <img class="w-[60px] h-[60px]" src="${firstProfile}/${f.profile}" alt="" srcset="">
                        <div class="font-bold text-start">
                            <span class="text-[12px] p-0">${f.team_name}</span>
                            <span class="text-[12px] p-0 block">Players : 2</span>
                            <div class="flex gap-2 bg-slate-100 text-[12px] p-0">
                                <span>Win : ${totalWins}</span>|
                                <span>Lose : ${totalLoss}</span>
                            </div>
                        </div>
                    `
                f.players.forEach(p => {
                    if (p.player_total_score !== null) {
                        if (Object.keys(p.player_score).length > 0) {
                            // alert('yes')
                            for (const key in p.player_score) {
                                if (p.player_score.hasOwnProperty(key)) {
                                    const item = p.player_score[key];
                                    console.log(`Key: ${key}, ID: ${item.id}, Score: ${item.score}`);
                                    totalFScore += item.score
                                }
                            }

                        }

                    }

                    if (Object.keys(p.player_score).length > 0) {
                        for (const key in p.player_score) {
                            if (p.player_score.hasOwnProperty(key)) {
                                const item = p.player_score[key];
                                console.log(`Key: ${key}, ID: ${item.id}, Score: ${item.score}`);
                                fPlayerScore += `
                                        <div class="flex justify-between items-end gap-5 font-bold shadow w-full mb-1 px-2">
                                            <img class="w-[30px] h-[30px]" src="${firstProfile}/${p.profile}" alt="" srcset="">
                                            <h1>${p.name}</h1>
                                            <span class="text-blue-500"> ${item.score}+</span>
                                        </div>
                                    `
                            }
                        }
                        //     p.player_score.forEach(ps => {
                        //     fPlayerScore +=`
                //         <div class="flex justify-between items-end gap-5 font-bold shadow w-full mb-1 px-2">
                //             <img class="w-[30px] h-[30px]" src="${firstProfile}/${p.profile}" alt="" srcset="">
                //             <h1>${p.name}</h1>
                //             <span class="text-blue-500"> ${ps.score}+</span>
                //         </div>
                //     `
                        // });
                    }
                    $('#renderFPlayerScores').html(fPlayerScore)
                })

                $('#fTScore').text(totalFScore)
                $('#renderFirstTeam').html(first)
            }
            const renderSecondTeam = (s) => {
                let second = ''
                let sPlayerScore = ''
                let totalSScore = 0
                let secondProfile = "{{ asset('storage') }}"
                // Check if game_result and game_result[0] are defined and provide default values if not
                const totalWins = (s.game_result && s.game_result[0] && s.game_result[0].totalWins) || 0;
                const totalLoss = (s.game_result && s.game_result[0] && s.game_result[0].totalLoss) || 0;
                second = `
                       
                        <div class="font-bold text-start">
                            <span class="text-[12px] p-0">${s.team_name}</span>
                            <span class="text-[12px] p-0 block">Players : 2</span>
                            <div class="flex gap-2 bg-slate-100 text-[12px] p-0">
                                <span>Win : ${totalWins}</span>|
                                <span>Lose : ${totalLoss}</span>
                            </div>
                        </div>
                         <img class="w-[60px] h-[60px]" src="${secondProfile}/${s.profile}" alt="" srcset="">
                    `
                s.players.forEach(p => {
                    // console.log(s.player_total_score)

                    if (p.player_total_score !== null) {
                        if (Object.keys(p.player_score).length > 0) {
                            // alert('yes')
                            for (const key in p.player_score) {
                                if (p.player_score.hasOwnProperty(key)) {
                                    const item = p.player_score[key];
                                    console.log(`Key: ${key}, ID: ${item.id}, Score: ${item.score}`);
                                    totalSScore += item.score
                                }
                            }

                        }

                    }
                    if (Object.keys(p.player_score).length > 0) {
                        // alert('yes')
                        for (const key in p.player_score) {
                            if (p.player_score.hasOwnProperty(key)) {
                                const item = p.player_score[key];
                                console.log(`Key: ${key}, ID: ${item.id}, Score: ${item.score}`);
                                sPlayerScore += `
                                        <div class="flex justify-between items-end gap-5 font-bold shadow w-full mb-1 px-2">
                                                <span class="text-red-500"> +${item.score}</span>
                                                <h1>${p.name}</h1>
                                                <img class="w-[30px] h-[30px]" src="${secondProfile}/${p.profile}" alt="" srcset="">
                                        </div>
                                    `
                            }
                        }

                    }

                    $('#renderSPlayerScores').html(sPlayerScore)
                })

                $('#sTScore').text(totalSScore)

                $('#renderSecondTeam').html(second)
            }
            const renderJudges = (judges, id) => {
                // console.log(active_id)
                let judge = ''
                let judgeProfile = "{{ asset('storage') }}"
                judges.forEach(j => {
                    if (id != j.id) {
                        judge += `
                            <a class="group flex flex-col bg-white shadow-sm rounded-xl hover:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800" href="#">
                            <label class="flex items-center gap-2 p-3 w-full bg-slate-100 border border-slate-100 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 group-hover:cursor-pointer">
                                <input type="radio" name="selectedJudge" value="${j.id}" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                <div class="flex items-center gap-1">
                                <img class="w-[60px] h-[50px] rounded-md" src="${judgeProfile}/${j.profile}" alt="">
                                <span class="font-bold">${j.name}</span>
                                </div>
                            </label>
                            
                            </a>
                        `
                    }

                });

                $('.renderJudgeTeams').html(judge)
            }
            const renderTeams = (teams) => {
                let team = ''
                let teamProfile = "{{ asset('storage') }}"
                teams.forEach(t => {
                    team += `
                        <a class="group flex flex-col bg-white shadow-sm rounded-xl hover:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800" href="#">
                        <label class="flex items-center gap-2 p-3 w-full bg-slate-100 border border-slate-100 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 group-hover:cursor-pointer">
                            <input type="checkbox" name="selectedTeams[]" value="${t.id}" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                            <div class="flex items-center gap-1">
                            <img class="w-[60px] h-[50px] rounded-md" src="${teamProfile}/${t.profile}" alt="">
                            <span class="font-bold">${t.team_name}</span>
                            </div>
                        </label>
                        
                        </a>
                    `
                });

                $('.renderTeams').html(team)
            }
            const changeTeams = (teams, active_id) => {
                console.log(active_id)
                let team = ''
                let teamProfile = "{{ asset('storage') }}"
                teams.forEach(t => {
                    if (t.id != active_id) {
                        team += `
                            <a class="group flex flex-col bg-white shadow-sm rounded-xl hover:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800" href="#">
                            <label class="flex items-center gap-2 p-3 w-full bg-slate-100 border border-slate-100 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 group-hover:cursor-pointer">
                                <input type="radio" name="selectedTeam" value="${t.id}" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                <div class="flex items-center gap-1">
                                <img class="w-[60px] h-[50px] rounded-md" src="${teamProfile}/${t.profile}" alt="">
                                <span class="font-bold">${t.team_name}</span>
                                </div>
                            </label>
                            
                            </a>
                        `
                    }
                });

                $('.renderTeams').html(team)
            }

            const renderCategories = (categories) => {
                console.log(categories.length)
                let category = ''

                if (categories.length > 0) {
                    categories.forEach(c => {
                        category += `
                        <a class="group flex flex-col bg-white shadow-sm rounded-xl hover:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800" href="#">
                        <label class="flex items-center gap-2 p-3 w-full bg-slate-100 border border-slate-100 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 group-hover:cursor-pointer">
                            <input type="number" name="event_id" value="${c.event_id}" class="hidden">
                            <input type="radio" name="category_id" value="${c.id}" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                            <div class="flex items-center gap-1">
                                <span class="font-bold">${c.category}</span>
                            </div>
                        </label>
                        
                        </a>
                    `
                    })
                    $('#stgame').attr('disabled', false)
                }else{
                    category += `
                        <div class="col-span-3 text-center text-red-500"><h1>There's is no available category!. Please create categories.</h1></div>
                    ` 
                    $('#stgame').attr('disabled', true)
                }
                
                $('#renderCategories').html(category)

            }
            const success = (t, m, i) => {
                Swal.fire({
                    title: t,
                    text: m,
                    icon: i
                });
            }

            const PrintDiv = ()=> {
                    var contents = document.getElementById("contents").innerHTML;
                    var frame1 = document.createElement('iframe');
                    frame1.name = "frame1";
                    frame1.style.position = "absolute";
                    frame1.style.top = "-1000000px";
                    document.body.appendChild(frame1);
                    var frameDoc = (frame1.contentWindow) ? frame1.contentWindow : (frame1.contentDocument.document) ? frame1.contentDocument.document : frame1.contentDocument;
                    frameDoc.document.open();
                    frameDoc.document.write(`<html><head><title>DIV Contents</title>`);
                        // Copy stylesheets from main document to iframe
                        var styles = document.querySelectorAll('link[rel="stylesheet"]');
                        styles.forEach(function(style) {
                            frameDoc.document.write(style.outerHTML);
                        });
                    frameDoc.document.write('</head><body>');
                    frameDoc.document.write(contents);
                    frameDoc.document.write('</body></html>');
                    frameDoc.document.close();
                    setTimeout(function () {
                        window.frames["frame1"].focus();
                        window.frames["frame1"].print();
                        document.body.removeChild(frame1);
                    }, 500);
                    return false;
                }
        </script>
    @endsection
</x-app-layout>
