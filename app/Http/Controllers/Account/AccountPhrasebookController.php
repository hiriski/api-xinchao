<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PhrasebookWithUserCollection;

class AccountPhrasebookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $phrases = Auth()->user()->phrases;
        return response()->json(new PhrasebookWithUserCollection($phrases));
    }
}
