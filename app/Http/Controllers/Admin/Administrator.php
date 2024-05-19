<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Judge;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Spatie\FlareClient\View;

class Administrator extends Controller
{
    public function index()
    {
        $events = Event::orderByDesc('created_at')->get();
        return view('admin.index', compact('events'));
    }

    public function event()
    {
        $events = Event::with(['category', 'category.subCategory','judge'])->orderByDesc('created_at')->get();
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
            'event_details' => 'required',
            'event_type' => 'required',
            'event_image' => 'required',
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
                'details' => $validated['event_details'],
                'type' => $validated['event_type'],
                'image' => $path,
            ]);

            //  if($event){
            //     $category = Category::create([
            //         'event_id'=>$event->id,
            //         'category_name'=>$request->categories[0],
            //     ]);

            //     if($category){
            //         foreach ($request->sub_categories as $key => $value) {
            //            SubCategory::create([
            //                 'category_id'=>$category->id,
            //                 'sub_category'=>$value,
            //                 'percentage'=>$request->sub_percentage[$key],
            //            ]);
            //         }
            //     }
            //  }
            return Redirect::route('admin.event')->with('status', 'success');
        }
    }

    // category
    public function category(Request $request)
    {
        $event_id = $request->id;
        $categories = Category::where('event_id', $event_id)->with('subCategory')->get();
        // dd($categories);
        return view('admin.category.category', compact('event_id', 'categories'));
    }
    // store
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

        return Redirect::route('admin.category', $request->event_id)->with(['save_category'=>'success','event_id'=>$request->event_id, 'message'=>'Category is successfully added!']);
    }

    //judge
    public function judge(Request $request){
        $event_id = $request->id;
        $event = Event::with(['category', 'judge'])->find($event_id);
        // dd($event);
        return view('admin.judge.judge', compact('event'));
    }
    //store
    public function judgeStore(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'position' => 'required',
        ]);
        // dd($request);
         // Generate a unique code
         $code = $this->generateUniqueCode();
        Judge::create([
            'event_id' =>$request->event_id,
            'name' =>$validated['name'],
            'address' =>$validated['address'],
            'position' =>$validated['position'],
            'code' => $code,
        ]);

        return Redirect::route('admin.judge',$request->event_id)->with(['judge-save'=>'success']);
    }

    private function generateUniqueCode()
    {
        // Generate a random string of 10 alphanumeric characters
        return strtoupper(Str::random(10));
    }
}
