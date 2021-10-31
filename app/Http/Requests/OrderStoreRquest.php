<?php

namespace App\Http\Requests;

class OrderStoreRquest extends AuthBaseRquest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order' => 'required'
        ];
    }
}
