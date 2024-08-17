<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TaxRequest extends FormRequest
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
      'name' => ['required', 'string'],
      'tax' => ['required', 'string'],
      'status' => 'nullable',
    ];

    // If it's an update request, add unique rule for tax except the current tax ID
    if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
      $rules['name'][] = Rule::unique('taxes')->ignore($this->route('tax'));
      $rules['tax'][] = Rule::unique('taxes')->ignore($this->route('tax'));
    } else { // For add requests
      $rules['name'][] = Rule::unique('taxes');
      $rules['tax'][] = Rule::unique('taxes');
    }

    return $rules;
  }

  public function messages(): array
  {
    return [
      'name.required' => 'The tax name field is required.',
      'tax.required' => 'The tax rate field is required.',
    ];
  }
}
