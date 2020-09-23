<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Phrasebook;

class FavoritePhrasebookController extends Controller {

    public function __construct() {
        $this->middleware('auth:sanctum');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param App\Models\Phrasebook $phrasebook
     * @return \Illuminate\Http\Response
     */
    public function store(Phrasebook $phrasebook) {
        if($phrasebook->addFavorite()) {
            return $this->responseOk();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phrasebook  $phrasebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phrasebook $phrasebook) {
        if($phrasebook->removeFavorite()) {
            return $this->responseOk();
        }
    }

    protected function responseOk() {
        return response()->json([
            'success' => true,
        ], JsonResponse::HTTP_CREATED);
    }
}
