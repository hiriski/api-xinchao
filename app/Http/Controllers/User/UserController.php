<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth:sanctum');
    }

    public function __invoke() {
        $user = Auth::user();
        return response()->json($user);
    }
}
