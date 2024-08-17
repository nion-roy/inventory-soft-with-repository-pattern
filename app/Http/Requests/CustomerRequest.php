<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
      'email' => ['nullable', 'email', Rule::unique('customers')->ignore($this->route('customer'))],
      'contact' => ['required', 'numeric', Rule::unique('customers')->ignore($this->route('customer'))],
      'address' => ['required', 'string'],
      'status' => ['nullable'],
    ];

    return $rules;
  }
}
