<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Models\PhrasebookCategory;
use App\Http\Requests\StorePhrasebookCategory;
use App\Http\Resources\PhrasebookCategory as PhrasebookCategoryResource;
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
     * @return PhrasebookCategoryCollection
     */
    public function index() {
        $categories = PhrasebookCategory::all();
        return new PhrasebookCategoryCollection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePhrasebookCategory $request
     * @return PhrasebookCategoryResource
     */
    public function store(StorePhrasebookCategory $request) {
        try {
            $data = $request->only([
                'id_ID', 'vi_VN', 'en_US', 'description', 'color_id', 'icon_name', 'icon_type', 'user_id'
            ]);
            $category = auth()->user()->categories()->create($data);
            return new PhrasebookCategoryResource($category);
        } catch (Exception $e) {
            return response()->json([
                'message'   => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param PhrasebookCategory $phrase
     * @return PhrasebookCategoryResource
     */
    public function show(PhrasebookCategory $phrase) {
        return new PhrasebookCategoryResource(
            Category::firstOrFail($phrase)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePhrasebookCategory $request
     * @param Integer $id
     * @return PhrasebookCategoryResource
     */
    public function update(StorePhrasebookCategory $request, $id) {
        try {
            $data = $request->all();
            $category = PhrasebookCategory::findOrfail($id);
            $category->update($data);
            return new PhrasebookCategoryResource($category);
        } catch (Exception $e) {
            return response()->json([
                'message'   => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PhrasebookCategory $phrase
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(PhrasebookCategory $phrase) {
        $phrase->delete();
        return response()->json([
            'message'   => 'Ok'
        ]);
    }
}
