<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('City information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex flex-col bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
                <div class="p-6 flex flex-col">
                    <ul class="mt-4 text-gray-700 dark:text-gray-300 space-y-2">
                        <li class="text-3xl font-bold">{{ $city->name }}</li>
                        <li>País: {{ $city->country }}</li>
                        @if ($city->population)
                            <li>Población: {{ $city->population }}</li>
                        @endif
                        <li>Coordenadas: Latitud: {{ $city->latitude }} - Longitud: {{ $city->longitude }}</li>
                    </ul>
                    <div class="mt-4">
                        <form action="{{ route('city.city.destroy', $city->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-block bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                Eliminar Ciudad
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
