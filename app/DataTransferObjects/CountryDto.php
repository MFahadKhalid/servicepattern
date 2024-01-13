<?php

namespace App\DataTransferObjects;
use App\Http\Requests\Web\Country\CountryRequest;

class CountryDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $phonecode,
        public readonly string $code,
    ) {}
    public static function fromCountryRequest(CountryRequest $request){
        return new self(
            name: $request->validated('name'),
            phonecode: $request->validated('phonecode'),
            code: $request->validated('code'),
        );
    }
    public function arrayForModel() : array {
        return [
            'name' => $this->name,
            'phonecode' => $this->phonecode,
            'code' => $this->code,
        ];
    }
}
