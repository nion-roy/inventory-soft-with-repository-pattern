<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
      'total_amount' => 'required|numeric',
      'paying_amount' => 'required|numeric',
      'due_amount' => 'numeric',
      'payment_type' => 'required',
      'payment_note' => 'nullable',
      'sale_note' => 'nullable',
    ];
  }
}
