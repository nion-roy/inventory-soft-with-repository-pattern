<?php
namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
      'brand' => ['required', 'string'],
      'image*' => ['required', 'mimes:png,jpg,jpeg', 'max:2048'],
      'status' => 'nullable',
    ];

    // If it's an update request, add unique rule for brand except the current brand ID
    if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
      $rules['brand'][] = Rule::unique('brands')->ignore($this->route('brand'));
    } else { // For add requests
      $rules['brand'][] = Rule::unique('brands');
    }

    return $rules;
  }


  public function messages(): array
  {
    return [
      'brand.required' => 'The brand name field is required.',
    ];
  }
}
