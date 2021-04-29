<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Phrasebook;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StorePhrasebook as PhraseRequest;
use App\Http\Resources\PhrasebookCollection;
use App\Http\Resources\Phrasebook as PhrasebookResource;

class PhrasebookController extends Controller {

    public function __construct() {
        $this->middleware('auth:sanctum')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return new PhrasebookCollection(
            Phrasebook::paginate(20)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StorePhrasebook  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhraseRequest $request) {
        $phrase = $request->merge([
            'created_by' => auth()->id()
        ])->only([
            'id_ID', 'vi_VN', 'en_US', 'notes', 'category_id', 'created_by'
        ]);
        Phrasebook::create($phrase);
        return $this->responseWithStatus(
            true,
            'Phrase created',
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id) {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StorePhrasebook  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhraseRequest $request, $id) {
        $phrase = Phrasebook::findOrFail($id);
        $phrase->id_ID = $request->json('id_ID');
        $phrase->vi_VN = $request->json('vi_VN');
        $phrase->en_US = $request->json('en_US');
        $phrase->notes = $request->json('notes');
        $phrase->category_id = $request->json('category_id');

        $userId = auth()->id();
        $phrase->updated_by = $phrase->created_by !== $userId ? $userId : null;
        
        $phrase->save();
        return $this->responseWithStatus(
            true,
            'Phrase updated',
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $phrase = Phrasebook::findOrFail($id);
        $phrase->delete();
        return $this->responseWithStatus(
            true,
            'Phrase deleted',
            JsonResponse::HTTP_OK
            // JsonResponse::HTTP_NO_CONTENT
        );
    }

    private function responseWithStatus($status, $message, $code) {
        return response()->json([
            'success'   => $status,
            'message'   => $message,
        ], $code);
    }
}
