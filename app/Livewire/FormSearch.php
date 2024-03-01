<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\City;

class FormSearch extends Component
{
    public $countries = [];
    public $states = [];
    public $cities = [];
    public $country;
    public $state;
    public $city;
    public $infoCity;

    public function mount()
    {
        try {
            $this->countries = $this->getCountries();
        } catch (\Exception $e) {
            Log::error('Error getting countries: ' . $e->getMessage());
            return back()->withErrors([
                'api_error' => 'Failed to retrieve countries from the API.',
            ]);
        }
    }

    public function getCountries()
    {
        $response = Http::withHeaders([
            'X-CSCAPI-KEY' => env('API_KEY'),
        ])->get('https://api.countrystatecity.in/v1/countries');

        $data = $response->json();

        $countries = [];
        foreach ($data as $country) {
            $countries[] = [
                'iso' => $country['iso2'],
                'name' => $country['name'],
            ];
        }

        return $countries;
    }

    public function getStates()
    {
        try {
            $response = Http::withHeaders([
                'X-CSCAPI-KEY' => env('API_KEY'),
            ])->get('https://api.countrystatecity.in/v1/countries/' . $this->country  . '/states/');
            
            $data = $response->json();

            $states_data = [];
            foreach ($data as $state) {
                $states_data[] = [
                    'iso' => $state['iso2'],
                    'name' => $state['name'],
                ];
            }

            $this->states = $states_data;
        } catch (\Exception $e) {
            Log::error('Error getting states: ' . $e->getMessage());
            $this->states = [];
        }
    }

    public function getCities()
    {
        try {
            $response = Http::withHeaders([
                'X-CSCAPI-KEY' => env('API_KEY'),
            ])->get('https://api.countrystatecity.in/v1/countries/' . $this->country  . '/states/' . $this->state . '/cities/');
            
            $data = $response->json();

            $cities_data = [];
            foreach ($data as $city) {
                $cities_data[] = [
                    'name' => $city['name'],
                ];
            }

            $this->cities = $cities_data;
        } catch (\Exception $e) {
            Log::error('Error getting cities: ' . $e->getMessage());
            $this->cities = [];
        }
    }

    public function getCity()
    {
        try {
            $response = Http::withHeaders([
                'X-Api-Key' => env('API_NINJAS_API_KEY'),
            ])->get('https://api.api-ninjas.com/v1/city?name=' . $this->city);

            if ($response->getStatusCode() === 200) {
                $this->infoCity = $response->json()[0];
            } else {
                $this->infoCity = null;
                return redirect()->back()->with('error', 'Error al recuperar información de la ciudad. Inténtalo de nuevo.');
            }
        } catch (\Exception $e) {
            $this->infoCity = null;
            return redirect()->back()->with('error', 'Hubo un error al obtener los detalles de la ciudad, ciudad no encontrada.');
        }
    }

}



