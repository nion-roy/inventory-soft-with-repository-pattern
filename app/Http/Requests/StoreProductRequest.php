<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
      'category_id' => ['required'],
      'product_name' => ['required', 'string'],
      'image*' => ['required', 'mimes:png,jpg,jpeg', 'max:2048'],
      'quantity' => ['required', 'numeric'],
      'product_details' => ['required', 'string'],
      'buying_price' => ['required', 'numeric'],
      'selling_price' => ['required', 'numeric'],
      'status' => ['nullable'],
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages()
  {
    return [
      'category_id.required' => 'The category field is required.',
    ];
  }
}
