<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\Event;
use App\Models\Game;
use App\Models\GameResult;
use App\Models\Judge;
use App\Models\notifyUser;
use App\Models\PercentageScore;
use App\Models\Player;
use App\Models\PlayerTotalScore;
use App\Models\Scorer;
use App\Models\SportCategory;
use App\Models\SubCategory;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Spatie\FlareClient\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class Administrator extends Controller
{
    public function index()
    {
        $events = Event::with('candidates')->orderByDesc('created_at')->get();
        $candidates = Candidate::get();
        $judges = Judge::get();
        $categories = Category::get();

        $activeEvents = Event::where('status',1)->first();
        $categoriesChart = [];
        $categoriesChartLoss = [];
        $teams = [];
        $type = '';
        if($activeEvents && $activeEvents->type === 'sport'){
            $type = 'sport';
            // Retrieve all categories
            $teams = Team::with(['gameResult'=>function($query){
                $query->selectRaw('team_id, SUM(CASE WHEN result = "win" THEN 1 ELSE 0 END) as totalWins, SUM(CASE WHEN result = "lose" THEN 1 ELSE 0 END) as totalLoss')
                ->groupBy('team_id'); 
            }])->get();
            // Sort the collection in descending order based on totalPercentage
            $teams = $teams->sortByDesc(function ($team) {
                return $team->gameResult->first()->totalWins ?? 0;
            });
            
            foreach ($teams as $team) {
                // dd(count($team->gameResult));
                // dd($team->gameResult);
                if(count($team->gameResult)>0){
                    $categoriesChart[] = ['x' => $team->team_name, 'y' => $team->gameResult->first()->totalWins];
                    $categoriesChartLoss[] = ['x' => $team->team_name, 'y' => $team->gameResult->first()->totalLoss];
                }
            }
           
            // dd($categoriesChart, $teams);
        }else{
            $type = 'cultural';
            // Retrieve all categories
            $categories = category::get();
            $teams = Candidate::with(['percentageScores'=>function($query){
                $query->selectRaw('candidate_id, SUM(total_score) as totalPercentage')
                ->groupBy('candidate_id');  
            }])
            ->get();

            // Sort the collection in descending order based on totalPercentage
            $teams = $teams->sortByDesc(function ($team) {
                return $team->percentageScores->first()->totalPercentage ?? 0;
            });

            // dd($teams);

            $categoriesCount = count($categories); // Assuming $categories is defined and is an array

            foreach ($teams as $team) {
                $totalScore = $team->percentageScores->first()->totalPercentage ?? 0;
                // dd($team->percentageScores->first());
                $percentage = $categoriesCount > 0 ? $totalScore / $categoriesCount : 0;
                $categoriesChart[] = ['x' => $team->name, 'y' => number_format($percentage, 1)];
            }
            // dd($categoriesChart);
        }
        return view('admin.index', compact('events', 'candidates', 'judges', 'categories', 'activeEvents','categoriesChart','categoriesChartLoss','teams','type'));
        // return view('admin.index', compact('events', 'candidates', 'judges', 'categories', 'activeEvents'));
    }

    public function event()
    {
        $events = Event::with(['category', 'category.subCategory', 'judge', 'candidates'])->where('type', '=', 'cultural')->orderByDesc('created_at')->get();
        // dd($events);
        return view('admin.event', compact('events'));
    }
    public function create()
    {
        return view('admin.event.create');
    }

    // add events
    public function store(Request $request)
    {
        // dd($request);

        $validated = $request->validate([
            'event_name' => 'required',
            'event_address' => 'required',
            'event_details' => 'required',
            'event_time' => 'required',
            'event_date' => 'required|date|after_or_equal:today',
            'event_type' => 'required',
            'event_image' => 'required|image',  // Ensure it's an image
            // 'categories' => 'required|array|min:1',
            // 'sub_categories' => 'required|array',
            // 'sub_percentage' => 'required|array',
        ]);

        if ($request->hasFile('event_image')) {
            // Store the uploaded file and update the user's profile picture
            $path = $request->file('event_image')->store('images', 'public');

            $event = Event::create([
                'name' => $validated['event_name'],
                'address' => $validated['event_address'],
                'details' => $validated['event_details'],
                'date' => $validated['event_date'],
                'time' => $validated['event_time'],
                'type' => $validated['event_type'],
                'image' => $path,
            ]);


            return Redirect::route('admin.event')->with('status', 'success');
        }
    }
    //edit events
    public function editEvent(Request $request)
    {
        $edit = Event::find($request->id);
        return view('admin.event.edit', compact('edit'));
    }
    //update events
    public function updateEvent(Request $request)
    {
        // dd($request);
        // Validate the request...
        $validated = $request->validate([
            'event_id' => 'required|integer|exists:events,id',
            'event_name' => 'required|string|max:255',
            'event_details' => 'required|string',
            'event_type' => 'required|string|max:50',
            'event_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_time' => 'required',
            'event_date' => 'required',
        ]);


        // Find the event
        $event = Event::findOrFail($request->event_id);
        // Check if a new image file is uploaded
        if ($request->hasFile('event_image')) {
            // Store the uploaded file and get the path
            $path = $request->file('event_image')->store('images', 'public');

            // Delete the old image file if it exists
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            // Set the new image path
            $event->image = $path;
        }

        // Update the event with other fields
        $event->name = $validated['event_name'];
        $event->details = $validated['event_details'];
        $event->type = $validated['event_type'];
        $event->date = $validated['event_date'];
        $event->time = $validated['event_time'];

        // Save the updated event
        $event->save();
        return Redirect::route('admin.event')->with('status', 'success');
    }

    // category
    public function category(Request $request)
    {
        $event_id = $request->id;
        $categories = Category::where('event_id', $event_id)->with('subCategory')->latest()->get();
        // dd($categories);
        return view('admin.category.category', compact('event_id', 'categories'));
    }
    // store category
    public function categoryStore(Request $request)
    {
        // dd($request);

        $validated = $request->validate([
            "categories" => 'required',
            "sub_categories" => 'required|array',
            "percentage" => 'required|array',
        ]);
        $totalPercentage = array_sum($validated['percentage']);
        // dd($totalPercentage);
        if($totalPercentage > 100 || $totalPercentage < 100){
            return Redirect::route('admin.category', $request->event_id)->with(['limit_category' => 'error', 'event_id' => $request->event_id, 'message' => 'Category is successfully added!']);
        }

        $category = Category::create([
            'event_id' => $request->event_id,
            'category_name' => $request->categories,
        ]);

        foreach ($validated['sub_categories'] as $key => $value) {
            // Check if the sub_category value is not null
            if ($value !== null) {
                // Check if the percentage value for this subcategory is not null
                $percentage = isset($request->percentage[$key]) ? $request->percentage[$key] : null;

                // Create the SubCategory only if the percentage value is not null
                if ($percentage !== null) {
                    SubCategory::create([
                        'category_id' => $category->id,
                        'sub_category' => $value,
                        'percentage' => $percentage,
                    ]);
                }
            }
        }

        return Redirect::route('admin.category', $request->event_id)->with(['save_category' => 'success', 'event_id' => $request->event_id, 'message' => 'Category is successfully added!']);
    }

    //destroy category
    public function categoryDestroy(Request $request){
        // dd($request->id);
        $category = Category::find($request->id);
        $eventID = $category->event_id;
        // dd($category);
        if($category){
            $category->delete();
            return Redirect::route('admin.category', $eventID)->with(['delete_category' => 'success', 'event_id' => $eventID, 'message' => 'Category is successfully deleted!']);
        }
    }

    //judge
    public function judge(Request $request)
    {
        $event_id = $request->id;
        $event = Event::with(['category', 'judge'])->find($event_id);
        // dd($event);
        return view('admin.judge.judge', compact('event'));
    }
    //store Jusge
    public function judgeStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'position' => 'required',
            'profile' => 'required|image',  // Ensure it's an image,
        ]);
        // dd($request);
        // Generate a unique code
        $code = $this->generateUniqueCode();
        //  create user account on table
        if ($request->hasFile('profile')) {
            // Store the uploaded file and update the user's profile picture
            $path = $request->file('profile')->store('judge', 'public');
            $judge = User::create([
                'name' => $validated['name'],
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'isAdmin' => false,
                'code' => $code,
                'profile' => $path,

            ]);
            Judge::create([
                'user_id' => $judge->id,
                'event_id' => $request->event_id,
                'name' => $validated['name'],
                'address' => $validated['address'],
                'position' => $validated['position'],
                'code' => $code,
                'profile' => $path,
            ]);
        }


        return Redirect::route('admin.judge', $request->event_id)->with(['judge-save' => 'success', 'message' => 'A new judge has been successfully added to the event.']);
    }

    //judge update
    public function judgeUpdate(Request $request)
    {
        // dd($request);
        $judge = Judge::with('event')->find($request->judge_id);
        if ($request->hasFile('judge_profile')) {
            $path = $request->file('judge_profile')->store('judge', 'public');
            $judge->update(['profile' => $path]);
        }

        $judge->update(['name' => $request->name, 'address' => $request->address, 'position' => $request->position]);
        return Redirect::route('admin.judge', $judge->event->id)->with(['judge-save' => 'success', 'message' => 'Judge ' . $judge->name . ' has been updated successfully.']);
    }
    //jugde code
    public function judgeCode(Request $request)
    {
        // dd($request);
        $code = Event::with('judge')->where('id', $request->event_id)->first();
        // dd($code);
        return response()->json(['codes' => $code]);
    }

    //candidate
    public function candidate(Request $request)
    {
        $event_id = $request->id;
        $event = Event::with(['category', 'judge', 'candidates'])->find($event_id);
        // dd($event);
        return view('admin.candidate.candidate', compact('event'));
    }

    //store candidate
    public function candidateStore(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'name' => 'required',
            'age' => 'required',
            'profile' => 'required|image',  // Ensure it's an image,
        ]);

        if ($request->hasFile('profile')) {
            // Store the uploaded file and update the user's profile picture
            $path = $request->file('profile')->store('profile', 'public');

            Candidate::create([
                'event_id' => $request->event_id,
                'name' => $validated['name'],
                'age' => $validated['age'],
                'profile' => $path,
            ]);


            return Redirect::route('admin.candidate', $request->event_id)->with(['candidate-status' => 'success', 'message' => 'A new candidate has been successfully added to the event.']);
        }
    }

    //candidate update
    public function candidateUpdate(Request $request)
    {
        // dd($request);
        $candidate = Candidate::with('event')->find($request->candidate_id);
        if ($request->hasFile('candidate_profile')) {
            $path = $request->file('candidate_profile')->store('profile', 'public');
            $candidate->update(['profile' => $path]);
        }

        $candidate->update(['name' => $request->name, 'age' => $request->age]);
        return Redirect::route('admin.candidate', $candidate->event->id)->with(['candidate-status' => 'success', 'message' => 'Candidate ' . $candidate->name . ' is successfully updated!']);
    }

    //cadidate destory
    public function candidateDestroy(Request $request)
    {
        // dd($request->id);
        $candidate = Candidate::with('event')->find($request->id);

        if ($candidate) {
            $candidate->delete();
        }

        return Redirect::route('admin.candidate', $candidate->event->id)->with(['candidate-status' => 'success', 'message' => 'Candidate ' . $candidate->name . ' is successfully deleted!']);
    }
    //start the event
    public function startEvent(Request $request)
    {
        
        $actEvent = Event::where('status',1)->first();
        $activeCategory = Category::with('subCategory')->where('status', true)->first();
        // dd($activeCategory);
        if($actEvent && $activeCategory != null){
            //printing process
            $dataToPrint = Category::with(['event.judge.votes.candidate.percentageScores','subCategory'])->get();
            //LEading candidates
            $leadingCandidatesForCategory = Candidate::with(['percentageScores'=>function($query) use($activeCategory){
                $query->selectRaw('candidate_id, SUM(total_score) as total_percentage')
                ->where('category_id', $activeCategory->id)
                ->groupBy('candidate_id');
            }])
                ->where('event_id', $actEvent->id)
                ->get();
            // dd($leadingCandidatesForCategory);
        }else{
            $dataToPrint = [];
            $leadingCandidatesForCategory = [];
        }

        if (!$activeCategory) {
            $activeCategory = Category::with('subCategory')->where('status', false)->first();
            
        }

        $activeEvents = Event::with([
            'candidates.votes' => function ($q) use ($activeCategory) {
                $q->where('category_id', $activeCategory->id);
            }, 'judge', 'category.subCategory', 'candidates.percentageScores'
        ])->find($request->id);
        //    dd($activeEvents->category);
        // Iterate over each candidate
        foreach ($activeEvents->candidates as $candidate) {
            // per criteria
            // $votePerCandidates = $this->calculateTotalPerCriteria($candidate, $activeCategory->subCategory);
            //total

            $votePerCandidates = $this->calculateTotalPercentage($candidate, $activeEvents->category);
            // dd($votePerCandidates);
            $candidate->vote_results = $votePerCandidates;
        }
        // dd($activeEvents);
        return view('admin.start', compact('activeEvents', 'activeCategory', 'dataToPrint', 'leadingCandidatesForCategory'));
    }

    //update the event status
    public function updateStatus(Request $request)
    {
        // dd($request);
        // Validate the request data
        $validated = $request->validate([
            'set_status' => 'required|in:0,1',
        ]);

        // Find the currently active event and set its status to false
        Event::where('status', 1)->update(['status' => 0]);

        // Find the event
        $event = Event::findOrFail($request->event_id);

        // Update the status
        $event->update([
            'status' => $validated['set_status']
        ]);

        // Return a response, possibly a redirect or a view
        return redirect()->back()->with(['status' => 'Event status is successfully set to ' . ($validated['set_status'] === '1' ? 'Online' : 'Offline')]);
    }

    //start voting
    public function startVoting(Request $request)
    {
        // dd($request->id);
        // Fetch the category using the provided ID
        $category = Category::findOrFail($request->id);

        // Check if there is already an active category
        $activeCategory = Category::where('status', true)->first();

        if ($activeCategory) {
            $activeCategory->update(['status' => false]);
            // If there is an active category, return with an error message
            // return Redirect::route('admin.event.start', $category->event_id)->with(['status' => "There is already an active category ongoing. Cannot activate."]);
        }
        $category->update(['status' => true]);
        return Redirect::route('admin.event.start', $category->event_id)->with(['status' => "Category is successfully set to active."]);

        // dd($category);

    }

    //edit category
    public function edit(Request $request)
    {
        // dd($request);
        $category = Category::with('subCategory')->find($request->id);
        // dd($category);
        return response()->json(['category' => $category]);
    }
    //update category and criteria
    public function update(Request $request)
    {
        // dd($request->type);
        $category = Category::with(['subCategory', 'event'])->find($request->category_id);

        $category->update(['category_name' => $request->category_name]);
        foreach ($request->criteria as $k => $c) {
            // dd($k);
            $category->subCategory[$k]->update(['sub_category' => $c, 'percentage' => $request->percentage[$k]]);
        }

        if ($category->status) {
            switch ($request->type) {
                case 'start':
                    return Redirect::route('admin.event.start', $category->event_id)->with(['status' => "Category is on-going unabled to update."]);
                    break;
                case 'category':
                    return Redirect::route('admin.category', $category->event_id)->with(['status' => "Category is on-going unabled to update."]);
                    break;

                default:
                    # code...
                    break;
            }
        } else {
            switch ($request->type) {
                case 'start':
                    return Redirect::route('admin.event.start', $category->event_id)->with(['updates' => "Category is updated successfully."]);
                    break;
                case 'category':
                    return Redirect::route('admin.category', $category->event_id)->with(['status' => "Category is updated successfully."]);
                    break;

                default:
                    # code...
                    break;
            }
        }
    }

    //cancel active category
    public function cancelEvent(Request $request)
    {
        // dd($request->id);
        $category = Category::find($request->id);
        if ($category) {
            $category->update(['status' => false]);
        }
        return Redirect::route('admin.event.start', $category->event_id)->with(['updates' => "Category is not active you can now edit it."]);
    }

    // sports
    public function sports()
    {
        $events = Event::with(['teams', 'sportsCategories','judge'])->where('type', '=', 'sport')->orderByDesc('created_at')->get();
        // dd($events);
        return view('admin.sports', compact('events'));
        // return view('admin.sports');
    }

    //sports create
    public function createSports(){
        return view('admin.sport.create');
    }

    //sports store
    public function storeSports(Request $request){
        $validated = $request->validate([
            'event_name' => 'required',
            'event_address' => 'required',
            'event_details' => 'required',
            'event_time' => 'required',
            'event_date' => 'required|date|after_or_equal:today',
            'event_type' => 'required',
            'event_image' => 'required|image',  // Ensure it's an image
            // 'categories' => 'required|array|min:1',
            // 'sub_categories' => 'required|array',
            // 'sub_percentage' => 'required|array',
        ]);

        if ($request->hasFile('event_image')) {
            // Store the uploaded file and update the user's profile picture
            $path = $request->file('event_image')->store('images', 'public');

            $event = Event::create([
                'name' => $validated['event_name'],
                'address' => $validated['event_address'],
                'details' => $validated['event_details'],
                'date' => $validated['event_date'],
                'time' => $validated['event_time'],
                'type' => $validated['event_type'],
                'image' => $path,
            ]);


            return Redirect::route('admin.sports')->with('status', 'success');
        }
    }

    //sports store teams
    public function storeTeam(Request $request){
        // dd($request);
        $validated = $request->validate([
            'team_name' => 'required',
            'team_profile' => 'required|image',  // Ensure it's an image,
        ]);

        if ($request->hasFile('team_profile')) {
            // Store the uploaded file and update the user's profile picture
            $path = $request->file('team_profile')->store('team_profile', 'public');

            Team::create([
                'event_id' => $request->event_id,
                'team_name' => $validated['team_name'],
                'profile' => $path,
            ]);


            return Redirect::route('admin.sports', $request->event_id)->with(['candidate-status' => 'success', 'message' => 'A new candidate has been successfully added to the event.']);
        }
    }

    //view teams
    public function team(Request $request){
        // dd($request->id);
        $team = Team::with('players')->find($request->id);

        //all teams
        // $teams = Team::with('players')
        // dd($team);
        return view('admin.sport.team', compact('team'));
    }

    //update teams profile
    public function updateTeam(Request $request){
        // dd($request);
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'team_name' => 'required|string|max:255',
            'team_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Find the team by ID
        $team = Team::find($request->team_id);

         // Check if team_image file is present
        if ($request->hasFile('team_image')) {
            // Store the file and get the path
            $path = $request->file('team_image')->store('team_profile', 'public');

            // Update the team record with the image path
            $team->update([
                'team_name' => $validated['team_name'],
                'profile' => $path,
            ]);
        } else {
            // Update only the team name if image is not present
            $team->update([
                'team_name' => $validated['team_name'],
            ]);
        }

        return Redirect::route('admin.sports.team', $request->team_id)->with(['success'=>'success', 'message'=>'Team profile successfully updated!']);
    }

    //update player
    public function updatePlayer(Request $request){
        // dd($request);

        if(empty($request->update_player_name)){
            return Redirect::route('admin.sports.team', $request->team_id)->with(['success'=>'error','title'=>'Update Failed', 'message'=>"Player name is required!"]);
        }
        // Find the player by ID
        $player = Player::find($request->update_player_id);
        // Check if team_image file is present
        if ($request->hasFile('update_player_profile')) {
            // Store the file and get the path
            $path = $request->file('update_player_profile')->store('player_profile', 'public');

            // Update the team record with the image path
            $player->update([
                'name' => $request->update_player_name,
                'profile' => $path,
            ]);
        } else {
            // Update only the team name if image is not present
            $player->update([
                'name' => $request->update_player_name,
            ]);
        }

        return Redirect::route('admin.sports.team', $request->team_id)->with(['success'=>'success','title'=>'Update Success', 'message'=>"Player successfully updated!"]);
    }

    //destro player
    public function destroyPlayer(Request $request){
        // dd($request->id);
        $player = Player::find($request->id);
        $team_id = $player->team_id;
        if($player){
            $player->delete();
            return Redirect::route('admin.sports.team', $team_id)->with(['success'=>'success','title'=>'Delete Success', 'message'=>"Player is no longer available on the system!"]);
        }
        // dd($team_id);
    }

    //destro player
    public function destroyScorer(Request $request){
        // dd($request->id);
        $scorer = Judge::find($request->id);
        // dd($scorer);
        $event_id = $scorer->event_id;
        if($scorer){
            $scorer->delete();
            return Redirect::route('admin.judge', $event_id)->with(['judge-destroy' => 'success', 'message' => 'Judge has been deleted successfully.']);
        }
        // dd($team_id);
    }

    //store player
    public function storePlayer(Request $request){
        // dd($request);

        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'player_name' => 'required|string|max:255',
            'player_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->hasFile('player_profile')){
            // Store the file and get the path
            $path = $request->file('player_profile')->store('player_profile', 'public');
        }

        Player::create(['team_id'=>$validated['team_id'], 'name'=>$validated['player_name'], 'profile'=>$path]);

        return Redirect::route('admin.sports.team', $request->team_id)->with(['success'=>'success', 'message'=>"Player successfully added!"]);
    }

    // category
    public function sportCategoryStore(Request $request){
        // dd($request);
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            // 'category' => 'required|string|max:255',
        ]);
        
        if(empty($request->category)){
            return Redirect::route('admin.sports')->with(['validation'=>true,'modal'=>true, 'event_id'=>$validated['event_id']]);
        }

        SportCategory::create([
            'event_id'=>$validated['event_id'],
            'category'=>$request->category,
        ]);

        return Redirect::route('admin.sports')->with(['validation'=>false,'modal'=>false, 'event_id'=>$validated['event_id']]);
    }

    //category edit
    public function sportCategoryUpdate(Request $request){
        // dd($request);
        $validated = $request->validate([
            'category_id' => 'required|exists:sport_categories,id',
            'event_id' => 'required|exists:events,id',
            // 'category' => 'required|string|max:255',
        ]);

        if(empty($request->category)){
            return Redirect::route('admin.sports')->with(['validation'=>true,'modal-edit'=>true, 'category_id'=>$validated['category_id'], 'event_id'=>$validated['event_id']]);
        }

        SportCategory::find($validated['category_id'])->update(['category'=>$request->category]);
        return Redirect::route('admin.sports')->with(['validation'=>false,'modal'=>false, 'event_id'=>$validated['event_id']]);
    }

    //game start
    public function game(Request $request){
        // dd($request->id);
        $sport = Event::with(['judge','teams','sportsCategories'=> function($q){
            $q->whereDoesntHave('game');
        }])->find($request->id);
        // dd($sport);

        $inGameCopy= Game::with(['sportCategory','team.players.playerTotalScore', 'team.scorer'])->where('status','active')->get();
        
        // dd($inGameCopy);
        // if($inGameCopy->isNotEmpty()){
            $inGame = Game::with(['sportCategory','team.players.playerTotalScore', 'team.scorer'=>function($query) use($inGameCopy){
                $query->with(['judge'])->whereIn('game_id',$inGameCopy->pluck('id'));
            }])->where('status','active')->get();
        // }
        $activeGame = Game::with([
            'team.gameResult'=>function($query){
                $query->selectRaw('team_id, SUM(CASE WHEN result = "win" THEN 1 ELSE 0 END) as totalWins, SUM(CASE WHEN result = "lose" THEN 1 ELSE 0 END) as totalLoss')
                ->groupBy('team_id'); 
            },
            'team.players.playerTotalScore', 
            'team.players.playerScore'])->where('status','active')->get();
        // dd($activeGame);
        $teamGameResultsCount = SportCategory::with(['gameResults'])->whereHas('gameResults')->get();
        // $gameCategory = SportCategory::get();
        // dd($teamGameResultsCount);

        if($activeGame && $activeGame->count() >= 2){
            // dd($activeGame[0]->team);
            $firstTeam = $activeGame[0]->team;
            $this->filterPlayerScores($firstTeam, $activeGame[0]->id);
            
            $secondTeam = $activeGame[1]->team;
            $this->filterPlayerScores($secondTeam, $activeGame[1]->id);
            
        }else{
            // Initialize variables
            $firstTeam = null;
            $secondTeam = null;
        }

        //print results
        // $printCategoryResultCopy = SportCategory::with(['gameResults'])->whereHas('gameResults')->get();
        // dd($printCategoryResultCopy);
        $printCategoryResults = SportCategory::with(['gameResults.team.players.playerScore'])->whereHas('gameResults')->get();

        
        // dd($printCategoryResults);
        return view('admin.game.game', compact('sport', 'inGame', 'activeGame','firstTeam','secondTeam','teamGameResultsCount', 'printCategoryResults'));

    }

    private function filterPlayerScores($team, $activeGameId){
        foreach ($team->players as $player) {
           // Filter out scores that do not match the active game ID
            $filteredScores = $player->playerScore->filter(function ($score) use ($activeGameId) {
                return $score->game_id === $activeGameId;
            });
            // Update the relationship with the filtered scores
            $player->setRelation('playerScore', $filteredScores);
        }
    }

    //end game
    public function endGame(Request $request){
        // Update the status of games
        $gamesU = Game::where('sport_category_id', $request->category_id)
        ->update(['status' => 'completed']);

        if ($gamesU) {
            // Retrieve the updated games along with related teams, players, and player scores
            $gameUpdated = Game::with(['team.players.playerTotalScore','sportCategory'])
                ->where('sport_category_id', $request->category_id)
                ->get();
            // dd($gameUpdated);
            // Iterate through each game to calculate the team scores and determine the winner and loser
            $teamScores = [];
            $event_id = 0;
            foreach ($gameUpdated as $game) {
                $teamScore = 0;
                // Calculate the total score for each team
                foreach ($game->team->players as $player) {
                    $teamScore += $player->playerTotalScore->total_score ?? 0;
                }
                $teamScores[$game->team->id] = $teamScore;
            }
            // Find the highest score
            $highestScore = max($teamScores);
            $lowestScore = min($teamScores);
            $winnerTeamId = array_search($highestScore, $teamScores);
            $loserTeamId = array_search($lowestScore, $teamScores);
        
            foreach ($gameUpdated as $key => $value) {
                // dd($value);
                $event_id = $value->sportCategory->event_id;
                if($value->team_id == $winnerTeamId){
                    GameResult::create([
                        'sport_category_id'=>$value->sport_category_id,
                        'team_id'=>$value->team_id,
                        'status'=>'completed',
                        'result'=>'win'
                    ]);
                }else{
                    GameResult::create([
                        'sport_category_id'=>$value->sport_category_id,
                        'team_id'=>$loserTeamId,
                        'status'=>'completed',
                        'result'=>'lose'
                    ]);
                }
                
            }
            return Redirect::route('admin.sports.game', $event_id)->with(['validation'=>false,'modal'=>false,'game'=>false, 'event_id'=>$event_id]);
        }

        
       

    }

    //team to battle
    public function teamToBattle(Request $request){
        // dd($request);
        // $validated = $request->validate([
        //     'category_id' => 'required|exists:sport_categories,id',
        // ]);

        if(!isset($request->selectedTeams) || count($request->selectedTeams) < 2 || count($request->selectedTeams) > 2 || !isset($request->category_id)){
            return Redirect::route('admin.sports.game', $request->event_id)->with(['validation'=>true,'modal'=>true, 'status'=>'false']); 
        }

        foreach ($request->selectedTeams as $value) {
            Game::create([
                'sport_category_id'=>$request->category_id,
                'team_id'=>$value,
                'status'=>'active',
            ]);
        }

        return Redirect::route('admin.sports.game', $request->event_id)->with(['validation'=>false,'modal'=>false, 'status'=>true]); 
        
    }

    //change team
    public function teamChange(Request $request){
        // dd($request);
        // $validated = $request->validate([
        //     'selectedTeam'=>'required',
        // ]);

        if(!isset($request->selectedTeam)){
            return Redirect::route('admin.sports.game', $request->event_id)->with(['validation'=>true,'modalChange'=>true, 'status'=>'false']);   
        }

        $game = Game::find($request->game_id)->update(['team_id'=>$request->selectedTeam]);
        if($game){
            return Redirect::route('admin.sports.game', $request->event_id)->with(['validation'=>false,'modal'=>false, 'status'=>true]); 
        }
    }

    //assigned judge to a sport
    public function assignedJudge(Request $request){
        // dd($request);
        if(!isset($request->selectedJudge)){
            return Redirect::route('admin.sports.game', $request->event_id)->with(['validation'=>true,'modalJudge'=>true, 'status'=>'false']);   
        }

        $assignedScorer = Scorer::where('game_id',$request->game_id)->first();
        if($assignedScorer){
             // Update the existing scorer
             $assignedScorer->update([
                'judge_id' => $request->selectedJudge,
             ]);
        }else{
             // Create a new scorer
            $assignedScorer = Scorer::create([
                'game_id'=>$request->game_id,
                'event_id'=>$request->event_id,
                'team_id'=>$request->team_id,
                'judge_id'=>$request->selectedJudge,
            ]);
        }
        return Redirect::route('admin.sports.game', $request->event_id)->with(['validation'=>false,'modal'=>false, 'status'=>true]);
    }

    //activate candidate
    public function activateCandidate(Request $request){
        // dd($request);
        $candidate = Candidate::find($request->candidate_id);
        // dd($candidate);
        if ($candidate) {
            $candidate->update(['isActive'=>true, 'counter'=>$request->counter]);

            //set notify
            notifyUser::create(['name'=>$candidate->name, 'profile'=>$candidate->profile, 'isShowed'=>true]);
            return Redirect::route('admin.event.start', $candidate->event_id)->with(['status' => "Candidate is enabled."]);
        }
    }

    

    private function generateUniqueCode()
    {
        // Generate a random string of 10 alphanumeric characters
        return strtoupper(Str::random(10));
    }

    private function calculateTotalPerCriteria($candidate, $subCategories)
    {
        // dd($subCategories);
        $candidateVotesPerCriteria = []; // Initialize here to reset for each candidate

        foreach ($candidate->votes as $vote) {
            $candidateVotes = json_decode($vote->criteria, true);
            $c = 0;
            foreach ($candidateVotes as $criteriaKey => $value) {
                if (!isset($candidateVotesPerCriteria[$criteriaKey])) {
                    $candidateVotesPerCriteria[$criteriaKey] = 0;
                }
                $percentage = $subCategories[$c]->percentage / 100;
                $candidateVotesPerCriteria[$criteriaKey] += ($value * $percentage);
                $c++;
            }
        }
        // Calculate the total by summing all criteria scores
        $candidateVotesPerCriteria['total'] = (array_sum($candidateVotesPerCriteria));

        return $candidateVotesPerCriteria;
    }

    private function calculateTotalPercentage($candidate, $categories)
    {
        // dd($categories);
        $totalCategory = count($categories);
        // dd($totalCategory);
        $candidateOverAllVotes = []; // Initialize here to reset for each candidate
        $overAllScore = 0;
        foreach ($candidate->percentageScores as $vote) {
            $overAllScore += $vote->total_score;
        }
        // Calculate the overall percentage
        // dd($overAllScore);
        $overallPercentage = $overAllScore / $totalCategory;
        // dd($overallPercentage);
        $candidateOverAllVotes['total'] = $overallPercentage;
        return $candidateOverAllVotes;
    }
}
