<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Models\PhrasebookCategory;
use App\Http\Resources\PhrasebookCategory as PhrasebookCategoryResource;
use App\Http\Requests\StorePhrasebookCategory;
use App\Http\Resources\PhrasebookCategoryCollection;

class PhrasebookCategoryController extends Controller {

    public function __construct() {
        $this->middleware('auth:sanctum')->except([
            'index', 'show'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories = PhrasebookCategory::all();
        return new PhrasebookCategoryCollection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePhrasebookCategory  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhrasebookCategory $request) {
        $category = new Category;
        $category->title = $request->title;
        $category->slug = Str::slug($request->title, '-');
        $category->save();
        return new PhrasebookCategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(PhrasebookCategory $phrase) {
        dd($phrase);
        return new PhrasebookCategoryResource(
            Category::where('slug', $slug)->firstOrFail()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $slug) {
        $category = Category::where('slug', $slug)->firstOrFail();
        $category->title = $request->title;
        $category->slug = Str::slug($request->title);
        $category->save();
        return new PhrasebookCategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhrasebookCategory $phrase) {
        $phrase->delete();
        return response()->json([
            'message'   => 'Ok'
        ]);
    }
}
