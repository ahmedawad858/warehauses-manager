<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h1 class="text-xl font-semibold dark:text-white mb-4">{{ __('transactions.create_transaction') }}</h1>

                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <!-- Item Dropdown -->
                    <div class="mb-4">
                        <label for="item_id"
                               class="block text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('transactions.select_item') }}</label>
                        <select id="item_id"  name="item_id"
                                @if($selectedItem == null)
                                    onclick="onSelect()"
                                @endif
                                class="mt-1 rtl:indent-5 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                            @if($selectedItem != null)
                                <option value="{{ $selectedItem->id }}" selected>{{ $selectedItem->name }}</option>
                            @else
                                <option value="" disabled selected>{{__('transactions.please_select_an_item' )}} </option>
                            @endif
                        </select>
                    </div>

                    <!-- Quantity Field -->
                    <div class="mb-4">
                        <label for="quantity"
                               class="block text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('transactions.quantity') }}</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1"
                               @if($selectedItem != null) max="{{ $selectedItem->quantity }}"  @endif
                               class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-300 ease-in-out dark:bg-blue-400 dark:hover:bg-blue-500">{{ __('transactions.create') }}</button>
                </form>
                <script>
                    function onSelect(){
                        window.location.href = "{{ route('items.index') }}";

                    }
                    document.getElementById("item_id").addEventListener('mousedown', function(e) {
                        e.preventDefault();
                        this.blur();
                        window.focus();
                    });
                    {{--window.onload = function () {--}}
                    {{--    alert("{{ __('transactions.please_select_an_item') }}");--}}
                    {{--};--}}
                </script>
        </div>
    </div>
</x-app-layout>
