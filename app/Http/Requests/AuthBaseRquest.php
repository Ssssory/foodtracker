<?php

namespace App\Http\Requests;

use App\Models\Point;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AuthBaseRquest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $token = $this->header('Authorization');
        if (!$token) {
            return false;
        }
        $point = Point::where('token', $token)->whereDate('token_start', '>', Carbon::now()->subDay())->first();
        if (!$point) {
            return false;
        }
        $this->merge(['point' => $point]);
        return true;
    }
}
