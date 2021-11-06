<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $newCategoryRules = [
        "title" => "string|min:5|max:255",
        "created_by_user_id" => "int",

    ];
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $page = request('page') ? request('page') : 1;
        $limit = request('limit') ? request('limit') : 15;
        $categories = $this->getAllCategories($limit, $page);
        return view('categories.index', compact('categories'));

    }

    private function getAllCategories($limit = 15, $page = 1)
    {
        return Category::orderByDesc('updated_at')->paginate($limit);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("categories.new");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $this->validateNewCategory($request);
        $category = new Category($request);
        $category->slug = $this->getSlug($request['title']);
        $category->save();
        return redirect("/categories");
    }

    private function getSlug($title)
    {
        return Str::slug($title);
    }

    private function validateNewCategory(Request $request)
    {
        $request['created_by_user_id'] = $request['created_by_user_id'] ?? auth()->id();
        return $this->validate($request, $this->newCategoryRules);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $workouts = $category->workouts;
        return view("workouts.index", compact('workouts', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workout  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request = $this->validateNewCategory($request);

        $category->update($request);

        return redirect("/categories");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
