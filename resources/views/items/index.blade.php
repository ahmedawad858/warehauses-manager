<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('items.title') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-6">
        <!-- Add Item Button (Visible only to head users) -->
        <div class="mb-6">
            <form action="{{ route('items.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                <!-- Warehouse Dropdown -->
                <div class="w-full md:w-1/3">
                    <label for="warehouse"
                           class="block text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('items.select_warehouse') }}</label>
                    <select id="warehouse" name="warehouse"
                            class="mt-1 rtl:indent-5 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option
                            value="" {{__($warehouse_id==-1?'selected':'')}}>{{ __('items.all_warehouses') }}</option>
                        @foreach ($warehouses as $warehouse)
                            <option
                                {{$warehouse_id==$warehouse->id?"selected":''}} value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Search Field -->
                <div class="w-full md:w-1/3">
                    <label for="search"
                           class="block text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('items.search_items') }}</label>
                    <input type="text" id="search" name="search" value="{{$keyword}}"
                           class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Search Button -->
                <div class="w-full md:w-1/3">
                    <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-300 ease-in-out dark:bg-blue-400 dark:hover:bg-blue-500">{{ __('items.search') }}</button>
                </div>
            </form>
        </div>


        @if(auth()->user()->role == 'head')
            <div class="flex">
                <a href="{{ route('items.create') }}"
                   class="mb-4 mx-auto inline-block px-6 py-2 bg-indigo-500 text-white font-semibold rounded-md hover:bg-indigo-600 transition duration-300 ease-in-out">{{__("items.add_item")}}</a>
            </div>
        @endif

        <div class="flex flex-wrap -mx-2">
            @foreach ($items as $item)
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-2 mb-4 0">
                    <div
                        class="bg-white flex flex-col dark:bg-gray-800 p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow dark:shadow-gray-700 duration-300 ease-in-out cursor-pointer min-h-full"
                        onclick="location.href='{{ route('items.show', $item) }}';">
                        <h2 class="text-xl font-semibold dark:text-white">{{ $item->name }}</h2>
                        <p class="dark:text-gray-300 mb-auto">{{ $item->description }}</p>

                        <div>
                            <!-- Conditionally show Edit and Delete buttons for head users -->
                            @if(auth()->user()->role == 'head')
                                <a href="{{ route('items.edit', $item) }}"
                                   class="mt-2 inline-block px-4 py-2 bg-gray-500 text-white font-semibold rounded-md hover:bg-gray-600 transition duration-300 ease-in-out">{{__("items.edit")}}</a>
                                <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="mt-2 px-4 py-2 bg-transparent text-red-500 font-semibold rounded-md  hover:underline  transition duration-300 ease-in-out">
                                        {{__("items.delete")}}</button>
                                </form>
                            @endif

                            <!-- View Transactions Button (Visible to all users) -->
                            @if(auth()->user()->role == 'employee')

                                <a href="{{ url('/transactions/create?item=' . $item->id) }}"
                                   class="mt-2 inline-block px-4 py-2 bg-blue-400 text-white rounded-md  dark:text-white font-semibold  hover:bg-blue-600 transition duration-300 ease-in-out">{{__("items.order_item")}}</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

</x-app-layout>
