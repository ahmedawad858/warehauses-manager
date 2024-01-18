<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('users.title') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4">
        <h1 class="font-semibold text-2xl  dark:text-white  mt-4">{{ __('users.index_title') }}</h1>
        <div class="mt-6 overflow-x-auto">
            <!-- User Table -->
            <table class="min-w-full w-full bg-white dark:bg-gray-800">
                <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-6 border-b border-gray-300 text-start text-sm leading-4 font-medium text-gray-700 dark:text-gray-300">{{ __('users.name') }}</th>
                    <th class="px-6 hidden sm:table-cell py-6 border-b border-gray-300 text-start text-sm leading-4 font-medium text-gray-700 dark:text-gray-300">{{ __('users.email') }}</th>
                    <th class="px-6 hidden md:table-cell py-6 border-b border-gray-300 text-start text-sm leading-4 font-medium text-gray-700 dark:text-gray-300">{{ __('users.role') }}</th>
                    <th class="px-6 py-6 border-b border-gray-300 text-end leading-4 text-sm  font-medium text-gray-700 dark:text-gray-300  ">{{ __('users.actions') }}</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                @foreach ($users as $user)
                   @if($user->id != auth()->user()->id )
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 dark:border-gray-700 dark:text-white">{{ $user->name }}</td>
                        <td class="px-6 py-4 hidden sm:table-cell whitespace-no-wrap border-b border-gray-300 dark:border-gray-700 dark:text-white">{{ $user->email }}</td>
                        <td class="px-6 py-4 hidden md:table-cell whitespace-no-wrap border-b border-gray-300 dark:border-gray-700 dark:text-white">{{ $user->role }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap text-end border-b border-gray-300 dark:border-gray-700">
                            <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-500">{{ __('users.edit') }}</a>
                        </td>
                    </tr>
                   @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
