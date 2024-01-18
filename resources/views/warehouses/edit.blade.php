<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold dark:text-white">{{ __('warehouses.edit_warehouse') }}</h1>

        <form action="{{ route('warehouses.update', $warehouse) }}" method="POST"
              class="mt-4 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <!-- Warehouse Name Input -->
            <div class="mb-6">
                <label for="name"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('warehouses.name') }}</label>
                <input type="text" id="name" name="name" value="{{ $warehouse->name }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                       required>
            </div>

            <!-- Warehouse Location Input -->
            <div class="mb-6">
                <label for="location"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('warehouses.location') }}</label>
                <input type="text" id="location" name="location" value="{{ $warehouse->location }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                       required>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-300 ease-in-out dark:bg-blue-400 dark:hover:bg-blue-500">{{ __('warehouses.save_changes') }}</button>
        </form>
    </div>
</x-app-layout>
