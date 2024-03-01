<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My cities') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex flex-col bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
                @if (count($cities) > 0)
                    @foreach ($cities as $city)
                    <a href="{{ route('city.city.show', $city['id']) }}" class="p-6 flex hover:bg-gray-700">
                        <svg class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>

                        <div class="flex-1 ml-2">
                            <div class="flex justify-between items-center">
                                <div class="w-full flex justify-between items-center">
                                    <span class="text-gray-800 text-lg dark:text-gray-200">
                                        {{ $city['name']}}, {{ $city['country']}}
                                    </span>
                                    <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $city['created_at']}}</small>
                                </div>
                            </div>
                            <p class="mt-4 text-gray-600 dark:text-gray-400">Created by {{ $city->user['name']}}.</p>
                        </div>
</a>
                    @endforeach
                @else
                <p class="text-gray-700 dark:text-gray-300 text-center text-lg font-lg rounded-md p-2">No has guardado ninguna ciudad aun.</p>
                @endif
            
                

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete(cityId) {
        if (confirm('¿Estás seguro de que quieres eliminar esta ciudad?')) {
            var form = document.getElementById('deleteForm_' + cityId);
            form.submit();
        }
    }
</script>