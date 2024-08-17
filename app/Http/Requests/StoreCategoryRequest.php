<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
    $rules = [
      'category' => ['required', 'string'],
      'status' => 'nullable',
    ];

    // If it's an update request, add unique rule for category except the current category ID
    if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
      $rules['category'][] = Rule::unique('categories')->ignore($this->route('category'));
    } else { // For add requests
      $rules['category'][] = Rule::unique('categories');
    }

    return $rules;
  }
}
