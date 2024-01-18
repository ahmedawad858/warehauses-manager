<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl mb-4 font-semibold dark:text-white">{{ __('users.edit_user') }}</h1>
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
            <form action="{{ route('users.update', $user) }}" method="POST" class="mt-4">
                @csrf
                @method('PUT')

                <!-- Display User Information -->
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('users.username') }}</label>
                    <div class="text-gray-900 dark:text-gray-300">{{ $user->name }}</div>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('users.email') }}</label>
                    <div class="text-gray-900 dark:text-gray-300">{{ $user->email }}</div>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('users.email_verified') }}</label>
                    <div class="text-gray-900 dark:text-gray-300">{{ $user->email_verified_at ? __('users.verified') : __('users.not_verified') }}</div>
                </div>

                <!-- Role Selection Dropdown -->
                <div class="mb-6">
                    <label for="role" class="block  text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('users.role') }}</label>
                    <div class="relative mt-3">
                        <div id="customSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <!-- Selected value will be shown here -->
                        </div>

                        <select id="role" name="role" class=" opacity-0 absolute inset-0   bg-gray-50 z-10   border border-gray-300  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option  value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="head" {{ $user->role == 'head' ? 'selected' : '' }}>Head of Warehouse Department</option>
                            <option value="keeper" {{ $user->role == 'keeper' ? 'selected' : '' }}>Warehouse Keeper</option>
                            <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 dark:bg-blue-400 dark:hover:bg-blue-500 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                    {{ __('users.apply_changes') }}
                </button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectElement = document.getElementById('role');
            const customSelect = document.getElementById('customSelect');
            console.log("running")
            // Function to update custom select value
            const updateCustomSelect = () => {
                customSelect.textContent = selectElement.options[selectElement.selectedIndex].text;
            };

            // Event listener for native select change
            selectElement.addEventListener('change', updateCustomSelect);

            // Initial update
            updateCustomSelect();
        });
    </script>
</x-app-layout>
