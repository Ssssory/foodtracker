<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'login' => 'required|min:6',
            'password' => 'required|min:6',
        ]);

        $point = Point::where('login', $request->login)->firstOrFail();

        if ($point) {
            $token = Str::random(16);
            $point->token = $token;
            $point->token_start = Carbon::now();
            $point->save();
        }

        return response()->json([
            "token" => $token,
            "point" => $point
        ]);
    }
}
