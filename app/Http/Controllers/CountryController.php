<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\CountryDto;
use App\DataTransferObjects\DataTableRequestDto;
use App\Http\Requests\DataTableAjaxRequest;
use App\Http\Requests\Web\Country\CountryRequest;
use App\Models\Country;
use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct(protected CountryService $service){
        //
    }
    public function index(){
        $data['title'] = 'Country';
        return view('pages.country' ,$data);
    }
    public function list(DataTableAjaxRequest $request){
        $dt = DataTableRequestDto::fromDataTableAjaxRequest($request);

        return response()->json($this->service->dataTableIndex($dt));
    }
    public function show(Country $country){
        return response()->json([
            'country' => $country
        ]);
    }
    public function store(CountryRequest $request){
        $this->service->store(CountryDto::fromCountryRequest($request));

        return response()->json([
            'type' => 'success',
        ]);
    }
    public function update(CountryRequest $request, Country $country){
        $this->service->update($country, CountryDto::fromCountryRequest($request));

        return response()->json([
            'type' => 'success',
        ]);
    }
    public function delete(Country $country){
        $this->service->delete($country);
        return response()->json([
            'type' => 'success',
        ]);
    }
}
