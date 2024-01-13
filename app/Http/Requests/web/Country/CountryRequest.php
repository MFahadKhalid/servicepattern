<?php

namespace App\Http\Requests\Web\Country;

use Illuminate\Foundation\Http\FormRequest;


class CountryRequest extends FormRequest
{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'name' => ['required' , 'string' , 'max:255' , 'unique:countries,name,'.$this->country?->id],
            'phonecode' => ['required' , 'integer' , 'max:500' , 'unique:countries,phonecode,'.$this->country?->id],
            'code' => ['required' , 'string' , 'max:255' , 'unique:countries,code,'.$this->country?->id],
        ];
    }
}
