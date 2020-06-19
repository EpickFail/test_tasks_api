<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
        return [
            'title' => 'required|unique:tasks,title|max:255',
            'status' => 'required|boolean',
            'responsible_id' => 'exists:users,id',
            'created_by' => 'exists:users,id',
            'deadline' => 'required|date|after:now'
        ];
    }
}
