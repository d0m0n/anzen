<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('カタログ新規作成') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('catalogs.store') }}">
                        @csrf

                        <!-- Provider ID -->
                        <div class="mb-4">
                            <label for="provider_id" class="block text-sm font-medium text-gray-700">Provider ID</label>
                            <input type="number" name="provider_id" id="provider_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>

                        <!-- Status ID -->
                        <div class="mb-4">
                            <label for="status_id" class="block text-sm font-medium text-gray-700">Status ID</label>
                            <input type="number" name="status_id" id="status_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>

                        <!-- County Name -->
                        <div class="mb-4">
                            <label for="county_name" class="block text-sm font-medium text-gray-700">County Name</label>
                            <input type="text" name="county_name" id="county_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>

                        <!-- Location Name -->
                        <div class="mb-4">
                            <label for="location_name" class="block text-sm font-medium text-gray-700">Location Name</label>
                            <input type="text" name="location_name" id="location_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>

                        <!-- Copy -->
                        <div class="mb-4">
                            <label for="copy" class="block text-sm font-medium text-gray-700">Copy</label>
                            <textarea name="copy" id="copy" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required></textarea>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required></textarea>
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" step="0.01" name="price" id="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>

                        <!-- Note -->
                        <div class="mb-4">
                            <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                            <textarea name="note" id="note" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">
                            保存
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
