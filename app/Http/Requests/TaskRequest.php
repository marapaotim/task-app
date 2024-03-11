<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Implement validation for creating/updating task with adding conditional unique for each task
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:1|max:100|unique:tasks,title,'.$this->id,
            'content' => 'required',
            'status' => 'required|in:to-do,in-progress,done',
        ];
    }
}
