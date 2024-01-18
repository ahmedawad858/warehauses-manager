<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('transactions.title') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-6">
        @if(auth()->user()->role == 'employee')
            <div class="flex">
                <a href="{{ route('transactions.create') }}" class="mb-4 mx-auto inline-block px-6 py-2 bg-indigo-500 text-white font-semibold rounded-md hover:bg-indigo-600 transition duration-300 ease-in-out">{{__("transactions.add_transaction")}}</a>
            </div>
        @endif


        <!-- Pending Transactions List -->


        @if(auth()->user()->role === 'head' || auth()->user()->role === 'employee')
            <div class="mb-8">
                <h2 class="text-xl font-semibold dark:text-white mb-2">{{ __('transactions.pending_transactions') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($pendingTransactions as $transaction)
                        <div
                            class="bg-white flex-col flex dark:bg-gray-800 p-4 rounded-lg shadow-md dark:shadow-gray-700">
                            <!-- Transaction details here -->
                            <h3 class="text-lg text-start   mb-3 font-semibold dark:text-white">{{ $transaction->item->name }}</h3>
                            <div class="overflow-x-auto mb-auto mt-auto">
                                <table class="w-full text-sm text-start text-gray-500 dark:text-gray-400">
                                    <tbody>
                                    <tr>
                                        <td class="font-bold italic">{{ __('transactions.warehouse') }}:</td>
                                        <td>{{ $transaction->warehouse->name }}</td>
                                    </tr>

                                    @if(auth()->user()->role === 'keeper' || auth()->user()->role === 'head')
                                        <tr>
                                            <td class="font-bold italic">{{ __('transactions.ordered_by') }}:</td>
                                            <td>{{ $transaction->user->name }}</td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <td class="font-bold italic">{{ __('transactions.quantity_in_warehouse') }}:
                                        </td>
                                        <td>{{ $transaction->item->quantity }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold italic">{{ __('transactions.quantity_requested') }}:</td>
                                        <td>{{ $transaction->quantity }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold italic">{{ __('transactions.date') }}:</td>
                                        <td>{{\Carbon\Carbon::parse($transaction->transaction_date)->format('m/d/Y') }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Action buttons -->
                            @if(auth()->user()->role === 'employee' && auth()->user()->id === $transaction->user_id)
                                <form action="{{ route('transactions.destroy', $transaction) }}" method="POST"
                                      class="mt-4 text-end">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-4 py-2 bg-red-400 text-white font-semibold rounded-md hover:bg-red-400 transition duration-300 ease-in-out dark:bg-red-600 dark:hover:bg-red-700">
                                        {{ __('transactions.delete') }}
                                    </button>
                                </form>
                            @endif

                            @if(auth()->user()->role === 'head')
                                <form action="{{ route('transactions.updateStatus') }}" method="POST"
                                      class="mt-4 text-end">
                                    @csrf
                                    @method("PUT")
                                    <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                                    <input type="hidden" name="new_status" value="accepted">
                                    <button type="submit"
                                            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-300 ease-in-out dark:bg-blue-600 dark:hover:bg-blue-700">
                                        {{ __('transactions.accept') }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        @endif

        <!-- Accepted Transactions List -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold dark:text-white mb-2">{{ __('transactions.accepted_transactions') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($acceptedTransactions as $transaction)
                    <div
                        class="bg-white flex-col flex dark:bg-gray-800 p-4 rounded-lg shadow-md dark:shadow-gray-700">
                        <!-- Transaction details here -->
                        <h3 class="text-lg text-start   mb-3 font-semibold dark:text-white">{{ $transaction->item->name }}</h3>
                        <div class="overflow-x-auto mb-auto mt-auto">
                            <table class="w-full text-sm text-start text-gray-500 dark:text-gray-400">
                                <tbody>
                                <tr>
                                    <td class="font-bold italic">{{ __('transactions.warehouse') }}:</td>
                                    <td>{{ $transaction->warehouse->name }}</td>
                                </tr>

                                @if(auth()->user()->role === 'keeper' || auth()->user()->role === 'head')
                                    <tr>
                                        <td class="font-bold italic">{{ __('transactions.ordered_by') }}:</td>
                                        <td>{{ $transaction->user->name }}</td>
                                    </tr>
                                @endif

                                <tr>
                                    <td class="font-bold italic">{{ __('transactions.quantity_in_warehouse') }}:
                                    </td>
                                    <td>{{ $transaction->item->quantity }}</td>
                                </tr>
                                <tr>
                                    <td class="font-bold italic">{{ __('transactions.quantity_requested') }}:</td>
                                    <td>{{ $transaction->quantity }}</td>
                                </tr>
                                <tr>
                                    <td class="font-bold italic">{{ __('transactions.date') }}:</td>
                                    <td>{{\Carbon\Carbon::parse($transaction->transaction_date)->format('m/d/Y') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Action buttons -->
                        @if(auth()->user()->role === 'keeper')
                            <form action="{{ route('transactions.updateStatus') }}" method="POST" class="mt-4 text-end">
                                @csrf
                                @method("PUT")
                                <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                                <input type="hidden" name="new_status" value="delivered">
                                <button type="submit"
                                        class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600 transition duration-300 ease-in-out dark:bg-green-600 dark:hover:bg-green-700">
                                    {{ __('transactions.mark_as_delivered') }}
                                </button>
                            </form>
                        @elseif(auth()->user()->role === 'head')
                            <form action="{{ route('transactions.updateStatus') }}" method="POST" class="mt-4 text-end">
                                @csrf
                                @method("PUT")
                                <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                                <input type="hidden" name="new_status" value="pending">
                                <button type="submit"
                                        class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-md hover:bg-yellow-600 transition duration-300 ease-in-out dark:bg-yellow-600 dark:hover:bg-yellow-700">
                                    {{ __('transactions.mark_as_not_accepted') }}
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>


        <!-- Delivered Transactions List -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold dark:text-white mb-2">{{ __('transactions.delivered_transactions') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($deliveredTransactions as $transaction)
                    <div
                        class="bg-white flex-col flex dark:bg-gray-800 p-4 rounded-lg shadow-md dark:shadow-gray-700">
                        <!-- Transaction details here -->
                        <h3 class="text-lg text-start   mb-3 font-semibold dark:text-white">{{ $transaction->item->name }}</h3>
                        <div class="overflow-x-auto mb-auto mt-auto">
                            <table class="w-full text-sm text-start text-gray-500 dark:text-gray-400">
                                <tbody>
                                <tr>
                                    <td class="font-bold italic">{{ __('transactions.warehouse') }}:</td>
                                    <td>{{ $transaction->warehouse->name }}</td>
                                </tr>

                                @if(auth()->user()->role === 'keeper' || auth()->user()->role === 'head')
                                    <tr>
                                        <td class="font-bold italic">{{ __('transactions.ordered_by') }}:</td>
                                        <td>{{ $transaction->user->name }}</td>
                                    </tr>
                                @endif

                                <tr>
                                    <td class="font-bold italic">{{ __('transactions.quantity_in_warehouse') }}:
                                    </td>
                                    <td>{{ $transaction->item->quantity }}</td>
                                </tr>
                                <tr>
                                    <td class="font-bold italic">{{ __('transactions.quantity_requested') }}:</td>
                                    <td>{{ $transaction->quantity }}</td>
                                </tr>
                                <tr>
                                    <td class="font-bold italic">{{ __('transactions.date') }}:</td>
                                    <td>{{\Carbon\Carbon::parse($transaction->transaction_date)->format('m/d/Y') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Action buttons -->
                        @if(auth()->user()->role === 'keeper')
                            <form action="{{ route('transactions.updateStatus') }}" method="POST" class="mt-4 text-end">
                                @csrf
                                @method("PUT")

                                <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                                <input type="hidden" name="new_status" value="accepted">
                                <button type="submit"
                                        class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-md hover:bg-yellow-600 transition duration-300 ease-in-out dark:bg-yellow-600 dark:hover:bg-yellow-700">
                                    {{ __('transactions.mark_as_un_delivered') }}
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</x-app-layout>
