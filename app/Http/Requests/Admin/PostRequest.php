<?php

namespace App\Http\Requests\Admin;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'tag_id' => [
                'nullable','integer',Rule::exists((new Tag)->getTable(),'id')
            ],
            'name' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'image' => ['nullable','image']
        ];
    }
}
