<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold dark:text-white mb-4">{{ __('items.edit_item') }}</h1>

            <form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Name Input -->
                <div class="mb-4">
                    <label for="name"
                           class="block text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('items.name') }}</label>
                    <input type="text" id="name" name="name" value="{{ $item->name }}"
                           class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                           required>
                </div>

                <!-- Description Input -->
                <div class="mb-4">
                    <label for="description"
                           class="block text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('items.description') }}</label>
                    <textarea id="description" name="description" rows="3"
                              class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $item->description }}</textarea>
                </div>

                <!-- Quantity Input -->
                <div class="mb-4">
                    <label for="quantity"
                           class="block text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('items.quantity') }}</label>
                    <input type="number" id="quantity" name="quantity" value="{{ $item->quantity }}"
                           class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                           required>
                </div>
                <!-- Warehouse Dropdown -->
                <div class="mb-4">
                    <label for="warehouse_id"
                           class="block text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('items.warehouse') }}</label>
                    <select id="warehouse_id" name="warehouse_id"
                            class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach ($warehouses as $warehouse)
                            <option
                                value="{{ $warehouse->id }}" {{ $item->warehouse_id == $warehouse->id ? 'selected' : '' }}>{{ $warehouse->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Image Input -->
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('items.image') }}</label>
                    <input type="file" id="image" name="image" class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <!-- Submit Button -->
                <button type="submit"
                        class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-300 ease-in-out dark:bg-blue-400 dark:hover:bg-blue-500">{{ __('items.save_changes') }}</button>
            </form>
        </div>
    </div>

</x-app-layout>
