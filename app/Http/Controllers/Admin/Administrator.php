<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\Event;
use App\Models\Judge;
use App\Models\Player;
use App\Models\SubCategory;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Spatie\FlareClient\View;
use Illuminate\Support\Facades\Storage;

class Administrator extends Controller
{
    public function index()
    {
        $events = Event::with('candidates')->orderByDesc('created_at')->get();
        $candidates = Candidate::get();
        $judges = Judge::get();
        $categories = Category::get();
        return view('admin.index', compact('events', 'candidates', 'judges', 'categories'));
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
            'event_date' => 'required',
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

        $activeCategory = Category::with('subCategory')->where('status', true)->first();
        if (!$activeCategory) {
            $activeCategory = Category::with('subCategory')->where('status', false)->first();
        }

        $activeEvents = Event::with([
            'candidates.votes' => function ($q) use ($activeCategory) {
                $q->where('category_id', $activeCategory->id);
            }, 'judge', 'category.subCategory', 'candidates.percentageScores'
        ])->find($request->id);
        //    dd($activeEvents);
        // Iterate over each candidate
        foreach ($activeEvents->candidates as $candidate) {
            // per criteria
            // $votePerCandidates = $this->calculateTotalPerCriteria($candidate, $activeCategory->subCategory);
            //total

            $votePerCandidates = $this->calculateTotalPercentage($candidate, $activeCategory->subCategory);
            // dd($votePerCandidates);
            $candidate->vote_results = $votePerCandidates;
        }
        // dd($activeEvents);
        return view('admin.start', compact('activeEvents', 'activeCategory'));
    }

    //update the event status
    public function updateStatus(Request $request)
    {
        // dd($request);
        // Validate the request data
        $validated = $request->validate([
            'set_status' => 'required|in:0,1',
        ]);

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
        $events = Event::with(['teams'])->where('type', '=', 'sport')->orderByDesc('created_at')->get();
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
            'event_date' => 'required',
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

    private function calculateTotalPercentage($candidate, $subCategories)
    {
        $totalCategory = count($subCategories);
        $candidateOverAllVotes = []; // Initialize here to reset for each candidate
        $overAllScore = 0;
        foreach ($candidate->percentageScores as $vote) {
            $overAllScore += $vote->total_score;
        }
        // Calculate the overall percentage
        $overallPercentage = $overAllScore / $totalCategory;
        // dd($overallPercentage);
        $candidateOverAllVotes['total'] = $overallPercentage;
        return $candidateOverAllVotes;
    }
}
