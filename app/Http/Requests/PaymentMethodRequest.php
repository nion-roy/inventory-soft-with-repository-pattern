<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
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
      'image*' => ['required', 'mimes:png,jpg,jpeg', 'max:2048'],
      'status' => 'nullable',
    ];

    // If it's an update request, add unique rule for payment except the current payment ID
    // if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
    //   $rules['name'][] = Rule::unique('payment_methods')->ignore($this->route('payment-methoad'));
    // } else { // For add requests
    //   $rules['name'][] = Rule::unique('payment_methods');
    // }


    if ($this->isMethod('POST')) {
      $rules['name'][] = Rule::unique('payment_methods');
    }

    return $rules;
  }

  public function messages(): array
  {
    return [
      'name.required' => 'The payment name field is required.',
    ];
  }
}
