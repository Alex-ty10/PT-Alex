<div>
    @if (session('error'))
        <p class="bg-red-500 text-red-100 text-center text-lg font-lg rounded-md p-2">{{ session('error')}}</p>
    @endif 
    <form wire:submit.prevent="getCity">
        @csrf   

        <div class="flex flex-col mb-4">
            <label for="country">{{ __('Country')}}</label>
            <select wire:change="getStates" wire:model="country" name="country" 
                class="block rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50">
                <option hidden value='default'>{{ __('Select a country') }}</option>
                @foreach ($countries as $country)
                    <option value="{{ $country['iso'] }}">{{ $country['name'] }} ({{ $country['iso'] }})</option> 
                @endforeach
            </select>
        </div>

        <div class="flex flex-col mb-4">
            <label for="state">{{ __('State')}}</label>
            <select wire:change="getCities" wire:model="state" name="state" id="state" 
                class="block rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50">
                <option hidden value='default'>{{ __('Select a state') }}</option>
                @foreach ($states as $state)
                    <option value="{{ $state['iso'] }}">{{ $state['name'] }}</option> 
                @endforeach
            </select>
        </div>

        <div class="flex flex-col mb-4">
            <label for="city">{{ __('City')}}</label>
            <select wire:model="city" name="city" 
                class="block rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50">   
                <option hidden value='default'>{{ __('Select a city') }}</option>
                @foreach ($cities as $city)
                    <option value="{{ $city['name'] }}">{{ $city['name'] }}</option> 
                @endforeach
            </select>
        </div>
        
        <x-primary-button type="submit" class="mt-4">Buscar</x-primary-button>
    </form>

    @if ($infoCity)
    <div class="mt-4">
        <h3 class="text-lg font-semibold">City Information</h3>
        <ul>
            <li>Nombre: {{ $infoCity['name'] }}</li>
            <li>País: {{ $infoCity['country'] }}</li>
            @if (isset($infoCity['population']))
               <li>Poblacion: {{ $infoCity['population'] }}</li>
            @endif
            <li>Latitud: {{ $infoCity['latitude'] }}   Longitude: {{ $infoCity['longitude'] }}</li>
        </ul>
        <form method="POST" action="{{ route('city.infoCity.store') }}">
            @csrf
            <input type="hidden" name="name" value="{{ $infoCity['name'] }}">
            <input type="hidden" name="country" value="{{ $infoCity['country'] }}">
            @if (isset($infoCity['population']))
                <input type="hidden" name="population" value="{{ $infoCity['population'] }}">
            @endif
            <input type="hidden" name="latitude" value="{{ $infoCity['latitude'] }}">
            <input type="hidden" name="longitude" value="{{ $infoCity['longitude'] }}">
            <x-primary-button type="submit" class="mt-4">Guardar Ciudad</x-primary-button>
        </form>
    </div>
@endif
</div>


