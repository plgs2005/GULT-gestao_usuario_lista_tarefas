<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTasksFormRequest extends FormRequest
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
            'name' => "required|min:4|max:20",
            'descripition' => "required|max:1000",
            'completionDate'=> "required",
            'user_id' => "required|exists:users,id",
            'task_status_id' => "required|exists:tasks_status,id"
        ];
    }
}
