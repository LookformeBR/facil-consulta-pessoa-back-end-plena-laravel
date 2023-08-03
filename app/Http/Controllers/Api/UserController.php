<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function user(): JsonResponse
    {
        return response()->json(auth()->user());
    }
}
