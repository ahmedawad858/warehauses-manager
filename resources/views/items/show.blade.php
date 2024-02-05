<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md sm:mt-20">
            @if ($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
            @endif

            <h2 class="text-2xl mt-3 font-semibold dark:text-white mb-4">{{ $item->name }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-3">{{ $item->description }}</p>
            <p class="text-gray-600 dark:text-gray-400 mb-3">{{ __('items.warehouse') }}: {{ $item->warehouse->name }}</p>
            <p class="text-gray-600 dark:text-gray-400 mb-3">{{ __('items.quantity') }}: {{ $item->quantity }}</p>
            <p class="text-gray-600 dark:text-gray-400 mb-3">{{ __('items.pending_transactions') }}: {{ $pendingQuantity }}</p>

            @if(auth()->user()->role == 'head')
                <a href="{{ route('items.edit', $item) }}" class="inline-block px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-300 ease-in-out dark:bg-blue-400 dark:hover:bg-blue-500 mb-2">{{ __('items.edit') }}</a>
                <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition duration-300 ease-in-out dark:bg-red-400 dark:hover:bg-red-500">{{ __('items.delete') }}</button>
                </form>
            @endif

            @if(auth()->user()->role == 'employee')
                <a href="{{ url('/transactions/create?item=' . $item->id) }}" class="block text-center px-4 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600 transition duration-300 ease-in-out  dark:bg-green-600 dark:hover:bg-green-500 mt-4">{{ __('items.order_item') }}</a>
            @endif
        </div>
    </div>


</x-app-layout>
