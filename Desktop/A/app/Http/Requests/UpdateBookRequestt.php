<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequestt extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user !== null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'title' => ['required'],
                'author' => ['required'],
                'isbn' => ['required'],
                'description' => ['required'],
            ];
        } else {
            return [
                'title' => ['sometimes', 'required'],
                'author' => ['sometimes', 'required'],
                'isbn' => ['sometimes', 'required'],
                'description' => ['sometimes', 'required'],
            ];
        }
    }
}
