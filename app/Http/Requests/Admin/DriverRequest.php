<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class DriverRequest extends FormRequest
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
                'username' => 'required',
                'email' => 'required|unique:users,email',
                'phone' => 'required|unique:users,phone',
                'image' => 'required|image|mimes:png,jpg,jpeg',
            ];
            if ($this->has('driver_id')) {
                $driverId = $this->input('driver_id');
                $rules = [
                    'driver_id'=>'required|exists:users,id',
                    'email' => [
                        'required',
                        Rule::unique('users')->ignore($driverId),
                    ],
                    'phone' => [
                        'required',
                        Rule::unique('users')->ignore($driverId),
                    ],
                    'image' => 'image|mimes:png,jpg,jpeg',
                ];
            }
    
            return $rules;
        
    }
}
