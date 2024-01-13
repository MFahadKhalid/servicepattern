<?php

namespace App\Services;

use App\DataTransferObjects\CountryDto;
use App\DataTransferObjects\DataTableRequestDto;
use App\Models\Country;



class CountryService
{
    private static $search_cols = [
        'name',
        'phonecode',
        'code',
    ];
    private static $order_cols = [
        'name',
        'phonecode',
        'code',
    ];
    public function dataTableIndex(DataTableRequestDto $dto): array {
        $country_count = Country::count();
        $countries = Country::query();
        if($dto->search['value'] != ''){
            foreach ($dto->columns as $col) {
                if(in_array($col['data'], self::$search_cols)){
                    $countries = $countries->orWhere($col['data'], 'like', "%".$dto->search['value']."%");
                }
            }
        }
        foreach ($dto->order as $order_type) {
            $col = $dto->columns[$order_type['column']]['data'];
            if(in_array($col, self::$order_cols)){
                $countries = $countries->orderBy($col, $order_type['dir']);
            }
        }
        $filtered_count = $countries->count();
        $countries = $countries->skip($dto->start)->take($dto->length)->get();
        $countries->map(function ($country) {
            $country->action = view('pages.country.action', ['country_id' => $country->id])->render();
        });
        return [
            'countries' => $countries,
            'draw' => $dto->draw,
            'recordsTotal' => $country_count,
            'recordsFiltered' => $filtered_count,
        ];
    }
    public function store(CountryDto $dto) : Country {
        return Country::create($dto->arrayForModel());
    }
    public function update(Country $country, CountryDto $dto): Country {
        return tap($country)->update($dto->arrayForModel());
    }
    public function delete(Country $country): bool{
        return $country->delete();
    }
}
