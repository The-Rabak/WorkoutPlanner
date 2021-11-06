<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Workout;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{

    private $newWorkoutRules = [
      "title" => "string|min:5|max:255",
      "description" => "string|min:5",
      "created_by_user_id" => "int",
      "url" => "url",
      "category_id" => "array",
      "category_id.*" => "int",
    ];

    private $updateWorkoutRules = [
      "title" => "string|min:5|max:255",
      "description" => "string|min:5",
      "url" => "url",
      "category_id" => "array",
      "category_id.*" => "int",
    ];
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $page = request('page') ? request('page') : 1;
        $limit = request('limit') ? request('limit') : 15;
        $workouts = $this->getAllWorkouts($limit, $page);
        return view("workouts.index", compact("workouts"));
    }

    private function getAllWorkouts($limit = 15, $page = 1)
    {
        return Workout::orderByDesc('updated_at')->paginate($limit);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("workouts.new", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request = $this->validateNewWorkout($request);
        $category_ids = $request['category_id'];
        unset($request['category_id']);
        $workout = new Workout($request);
        $workout->save();
        $workout->categories()->attach($category_ids);
        return redirect("/workouts");
    }

    private function validateNewWorkout($request)
    {
        $request['created_by_user_id'] = $request['created_by_user_id'] ?? auth()->id();
        return $this->validate($request, $this->newWorkoutRules);
    }

    private function validateUpdateWorkout($request)
    {
        return $this->validate($request, $this->updateWorkoutRules);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function show(Workout $workout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function edit(Workout $workout)
    {
        $categories = Category::all();
        return view("workouts.edit", compact("workout", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workout $workout)
    {
        $request = $this->validateUpdateWorkout($request);
        $category_ids = $request['category_id'];
        unset($request['category_id']);

        $workout->update($request);

        $workout->categories()->detach();
        $workout->categories()->attach($category_ids);

        return redirect("/categories");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workout $workout)
    {
        //
    }
}
