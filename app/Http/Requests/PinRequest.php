<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PinRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'image' => 'required|image|max:4000'
        ];

        //Image is not required for pin updating.
        //In fact, user may choose to leave it blank in
        //order to keep the previous uploaded image
        if($this->method() == 'PATCH'){
            $rules = array_merge($rules, [
                'image' => 'image|max:4000'
            ]);
        }

        return $rules;
    }
}
