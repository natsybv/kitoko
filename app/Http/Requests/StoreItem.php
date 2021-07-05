<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItem extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'item_name' => 'bail|required|string|min:3',
            'price' => 'bail|required|integer|min:100',
            'picture' => 'bail|required|image|mimes:jpeg,png',
        ];
    }
}
