<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Category;
use App\Models\Event;
use App\Models\Game;
use App\Models\Judge;
use App\Models\notifyUser;
use App\Models\PercentageScore;
use App\Models\PlayerScore;
use App\Models\PlayerTotalScore;
use App\Models\Scorer;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class JudgeController extends Controller
{
    //authenticate
    public function index()
    {
        $id = auth()->user()->id;
        $judgeWithEvent = Judge::with('event')->where('user_id', $id)->first();
        // dd($judgeWithEvent);
        return view('judge.index', compact('judgeWithEvent'));
    }

    //sports
    public function sports()
    {
        $id = auth()->user()->id;
        // Step 1: Fetch the active game with the necessary conditions
        $activeGameCopy = Scorer::where('judge_id', $id)
            ->whereHas('game', function ($q) {
                $q->where('status', 'active');
            })
            ->first();
        // // dd($activeGameCopy);
        // $activeGame = Scorer::with(['game.sportCategory.event','team.players.playerTotalScore', 'team.players.playerScore'=>function($query) use($activeGameCopy){
        //     $query->selectRaw('player_id, game_id, sum(score) as totalScore')
        //         ->where('game_id',$activeGameCopy->game_id)
        //         ->groupBy('player_id','game_id'); 
        // }])
        // ->where('judge_id', $id)
        // ->whereHas('game', function($q){
        //     $q->where('status','active');
        // })
        // ->first();
        // $filteredGames = $activeGame->filter(function ($value, $key) {
        //     return optional($value->game)->status !== 'completed';
        // });
        // dd($activeGame);
        //get the event judge
        if ($activeGameCopy) {
            $activeGame = Scorer::with([
                'game.sportCategory.event',
                'team.gameResult' => function ($query) {
                    $query->selectRaw('team_id, 
                                    SUM(CASE WHEN result = "win" THEN 1 ELSE 0 END) as totalWins, 
                                    SUM(CASE WHEN result = "lose" THEN 1 ELSE 0 END) as totalLosses')
                        ->groupBy('team_id');
                },
                'team.players.playerTotalScore' => function ($query) use ($activeGameCopy) {
                    $query->selectRaw('id, player_id, game_id, total_score')
                        ->where('game_id', $activeGameCopy->game_id);
                }
            ])->find($activeGameCopy->id);
            // dd($activeGame);
            $judges = Event::with('judge')
                ->where('id', $activeGame->event_id)
                ->first();

            $filteredJudges = $judges->judge->filter(function ($judge) use ($id) {
                // dd($judge->id);
                return $judge->id !== $id;
            });
            // Get the first item from the filtered collection
            $versus = $filteredJudges->first();
            // dd($versus->id);

            // $activeGame = DB::table('scorers')->select('scorers.*')->where('judge_id', $id)->first();

            $enemyTeamCopy = Scorer::where('judge_id', $versus->id)
                ->whereHas('game', function ($q) {
                    $q->where('status', 'active');
                })
                ->first();
            // dd($enemyTeamCopy->game_id);
            $enemyTeam = Scorer::with([
                'game.sportCategory.event',
                'team.gameResult' => function ($query) {
                    $query->selectRaw('team_id, 
                                    SUM(CASE WHEN result = "win" THEN 1 ELSE 0 END) as totalWins, 
                                    SUM(CASE WHEN result = "lose" THEN 1 ELSE 0 END) as totalLosses')
                        ->groupBy('team_id');
                },
                'team.players.playerTotalScore' => function ($query) use ($enemyTeamCopy) {
                    $query->selectRaw('id, player_id, game_id, total_score')
                        ->where('game_id', $enemyTeamCopy->game_id);
                }
            ])
                ->where('judge_id', $versus->id)
                ->whereHas('game', function ($q) {
                    $q->where('status', 'active');
                })
                ->first();
            // dd($enemyTeam);
            $endGame = Scorer::with(['game' => function ($q) {
                $q->where('status', 'active');
            }])->first();
        }


        // dd($activeGame);

        if (empty($endGame)) {
            return Redirect::route('judge.dashboard')->with(['response' => "The game is not ready yet, Please wait until its ready!."]);
        } else if (optional($endGame->game)->status == 'completed') {
            return Redirect::route('judge.dashboard')->with(['response' => "The game is already ended!."]);
        } else if (!$activeGame || !$enemyTeam) {
            return Redirect::route('judge.dashboard')->with(['response' => "There's is no team asigned to you or enemy team is not set!, informed the administrator about this."]);
        }
        return view('judge.sports.sport', compact('activeGame', 'enemyTeam'));
    }

    //player score stored
    public function sportsPlayerScore(Request $request)
    {
        // dd($request);
        if (empty($request->score)) {
            // dd('yes');
            return Redirect::route('judge.sports')->with(['error' => true]);
        }

        $playerScore = PlayerScore::create([
            'game_id' => $request->game_id,
            'team_id' => $request->team_id,
            'event_id' => $request->event_id,
            'judge_id' => $request->judge_id,
            'player_id' => $request->player_id,
            'score' => $request->score,
        ]);
        if ($playerScore) {
            // Find the PlayerTotalScore by player_id
            $playerTotalScore = PlayerTotalScore::where('player_id', $playerScore->player_id)->where('game_status', 0)->where('game_id', $playerScore->game_id)->first();
            if ($playerTotalScore) {
                // Update the existing score
                $playerTotalScore->update([
                    'total_score' => $playerTotalScore->total_score + $playerScore->score,
                ]);
            } else {
                // Create a new PlayerTotalScore record
                PlayerTotalScore::create([
                    'game_id' => $playerScore->game_id,
                    'player_id' => $playerScore->player_id,
                    'total_score' => $playerScore->score,
                    'game_status' => false, //means on going
                ]);
            }
        }
        return Redirect::route('judge.sports')->with(['success' => true]);
    }

    //update the total score
    public function sportsPlayerScoreUpdate(Request $request)
    {
        // dd($request);
        $scoreId = $request->total_score_id;
        if (empty($request->player_total_score)) {
            return Redirect::route('judge.sports')->with(['error' => true]);
        }
        $playerTotalScore = PlayerTotalScore::find($scoreId);
        if ($playerTotalScore) {
            $playerTotalScore->update(['total_score' => $request->player_total_score]);
            // Check if the update was successful
            if ($playerTotalScore->wasChanged('total_score')) {
                // Find the latest PlayerScore for the given player_id and delete it
                $latestPlayerScore = PlayerScore::where('player_id', $playerTotalScore->player_id)
                    ->orderBy('created_at', 'desc')
                    ->first();
                if ($latestPlayerScore) {
                    $latestPlayerScore->delete();
                }
            }
        }
        return Redirect::route('judge.sports')->with(['success' => true]);
    }

    // display candidates
    public function candidates()
    {
        // active events
        $activeEvent = Event::with(['category', 'candidates'])
            ->where('status', true)
            ->whereHas('category', function ($query) {
                $query->where('status', true);
            })
            ->first();

        $eventCategory = Category::with(['subCategory', 'event.judge'])
            ->where('status', true)
            ->first();
        // dd($eventCategory);
        if ($eventCategory) {
            $categoryId = $eventCategory->id;
            $judgeId = Auth::user()->id;
            $candidatesWithVotesInCategory = Candidate::whereHas('votes', function ($query) use ($categoryId, $judgeId) {
                $query->where('category_id', $categoryId)->where('judge_id', $judgeId);
            })->with(['votes' => function ($query) use ($categoryId, $judgeId) {
                $query->select('id', 'candidate_id', 'judge_id')->where('category_id', $categoryId)->where('judge_id', $judgeId);
            }])
                ->get();
        }

        // dd($candidatesWithVotesInCategory);

        if (!$activeEvent) {
            return Redirect::route('judge.dashboard')->with(['response' => "Event is not ready yet, wait for the event to start."]);
        }
        return view('judge.candidate', compact('activeEvent', 'eventCategory', 'candidatesWithVotesInCategory'));
    }

    //vote
    public function vote(Request $request)
    {
        // dd($request);
        $criteriaVotes = [];
        $activeCategory = Category::with(['subCategory', 'event.judge'])->where('status', true)->first();
        $N = count($activeCategory->event->judge); //total judges
        $mpts = $N * 100;
        $totalScore = 0;
        // $totalSubPercentage = 0;
        foreach ($activeCategory->subCategory as $key => $criteria) {
            // dd($criteria->sub_category);
            $criteriaVotes[$criteria->sub_category] = floatval($request->criteria[$key]);
            //total percentage for all this category
            // $totalSubPercentage += $criteria->percentage;
            $totalScore += floatval($request->criteria[$key]);
        }
        // dd($totalScore);
        $percentage = round(($totalScore / $mpts) * 100, 1); //by default its set to 100%
        // dd($percentage);
        $vote = Vote::create([
            'candidate_id' => $request->candidate_id,
            'judge_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'criteria' => json_encode($criteriaVotes)
        ]);
        // dd($vote);
        if ($vote) {
            PercentageScore::create([
                'vote_id' => $vote->id,
                'candidate_id' => $request->candidate_id,
                'judge_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'total_score' => $percentage
            ]);
        }

        return Redirect::route('judge.candidates')->with(['status' => true, 'message' => 'Successfully recorded your votes!']);
    }

    //edit
    public function edit(Request $request)
    {
        // dd($request->id);
        $vote = Vote::with(['percentages'])->where('id', $request->id)->first();
        // dd($vote);
        return response()->json(['vote' => $vote]);
    }
    //update
    public function update(Request $request)
    {
        // dd($request);
        $criteriaVotes = [];
        // $activeCategory = Category::with('subCategory')->where('status',true)->first();
        $activeCategory = Category::with(['subCategory', 'event.judge'])->where('status', true)->first();
        $N = count($activeCategory->event->judge); //total judges
        $mpts = $N * 100;
        $totalScore = 0;
        foreach ($activeCategory->subCategory as $key => $criteria) {
            $criteriaVotes[$criteria->sub_category] = floatval($request->criteria[$key]);
            $totalScore += floatval($request->criteria[$key]);
        }

        $percentage = round(($totalScore / $mpts) * 100, 1); //by default its set to 100%
        $updateVote = Vote::find($request->vote_id)->update(['criteria' => json_encode($criteriaVotes)]);

        if ($updateVote) {
            $updatePercentage = PercentageScore::where('vote_id', $request->vote_id);
            // dd($updatePercentage);
            $updatePercentage->update(['total_score' => $percentage]);
        }
        return Redirect::route('judge.candidates')->with(['status' => true, 'message' => 'Successfully recorded your votes!']);
    }

    //active update
    public function isActiveUpdate(Request $request){
        // dd($request->candidate_id);
        $candidate = Candidate::find($request->candidate_id);
        // dd($candidate);
        if($candidate){
            $candidate->update(['isActive'=>false]);
            return response()->json(['status'=>'success']);
        }
    }

    //get notify 
    public function notifyJudge(){
        $needtoShow = notifyUser::where('isShowed',1)->where('type','judge')->first();
        return response()->json(['data'=>$needtoShow]);
    }
    //update notify
    public function notifyJudgeUpdate(Request $request){
        $needtoUpdate = notifyUser::find($request->id);
        if ($needtoUpdate) {
            $needtoUpdate->update(['isShowed'=>0]);
            return response()->json(['status'=>'success']);
        }
        // dd($needtoUpdate);
        // return response()->json(['data'=>$needtoShow]);
    }
    //request for edit
    public function notifyJudgeModefied($userId, $candidateId, Request $request){
        
        $judge = Judge::find($userId);
        $candidate = Candidate::find($candidateId);
        $existedRequest = notifyUser::where('candidate_id',$candidateId)->where('isShowed', true)->first();
        // dd($existedRequest);
        if($existedRequest){
            return Redirect::route('judge.candidates')->with(['requested'=>'error']);
        }
         //set notify
         notifyUser::create(['name'=>$judge->name, 'profile'=>$judge->profile, 'isShowed'=>true, 'type'=>'admin', 'candidate_id'=>$candidate->id]);

         return Redirect::route('judge.candidates')->with(['requested'=>'success']);
    }
}
