<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => ['required','string','max:255'],
        ];
    }
}
