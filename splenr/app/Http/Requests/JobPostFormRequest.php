<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:5',
            'feature_image' => 'required|mimes:png,jpeg,jpg,webp,svg|max:5120',
            'description' => 'required|min:10',
            'roles' => 'required|min:10',
            'requirements' => 'required|min:15',
            'job_type' => 'required',
            'address' => 'required',
            'date' => 'required',
            'salary' => 'required'
        ];
    }
}
