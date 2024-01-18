<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('warehouses.title') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-6">
        <!-- Add Warehouse Button -->
        @if(auth()->check() && auth()->user()->role == 'head')
            <div class="flex">
                <a href="{{ route('warehouses.create') }}"
                   class="mb-4 mx-auto inline-block px-6 py-2 bg-indigo-500 text-white font-semibold rounded-md hover:bg-indigo-600 transition duration-300 ease-in-out">{{__('warehouses.add_warehouse')}}</a>
            </div>
        @endif

        <div class="flex flex-wrap -mx-2">
            @foreach ($warehouses as $warehouse)
                <div class="w-full  sm:w-1/2 md:w-1/3 lg:w-1/4 px-2  mb-4">
                    <div class="bg-white flex min-h-full flex-col dark:bg-gray-800 p-4 rounded-lg  shadow-md">
                        <h2 class="text-xl font-semibold dark:text-white">{{ $warehouse->name }}</h2>
                        <p class="dark:text-gray-300 mb-auto     ">{{ $warehouse->location }}</p>

                        <!-- View Items Button -->
                        <a href="{{ route('items.index', ['warehouse' => $warehouse->id]) }}"
                           class="mt-4  text-center inline-block px-4 py-2 bg-gray-600 text-white font-semibold rounded-md hover:bg-gray-700 transition duration-300 ease-in-out">{{__('warehouses.view_items')}}</a>

                        @if(auth()->check() && auth()->user()->role == 'head')
                            <!-- Edit Button -->
                            <div class="flex flex-nowrap gap-2">
                                <a href="{{ route('warehouses.edit', $warehouse) }}"
                                   class="mt-2 grow text-center inline-block px-4 py-2 bg-gray-500 text-white font-semibold rounded-md hover:bg-gray-600 transition duration-300 ease-in-out">{{__("warehouses.edit")}}</a>

                                <!-- Delete Button -->
                                <form action="{{ route('warehouses.destroy', $warehouse) }}" method="POST"
                                      class="inline-block grow ">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="mt-2 w-full px-4 py-2 text-center text-red-600  font-semibold rounded-md hover:underline transition duration-300 ease-in-out">{{__("warehouses.delete")}}</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
