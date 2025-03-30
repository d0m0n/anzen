<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Catalog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('catalogs.update', $catalog) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="provider_id" class="block text-sm font-medium text-gray-700">Provider ID</label>
                            <input type="text" name="provider_id" id="provider_id" value="{{ $catalog->provider_id }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="status_id" class="block text-sm font-medium text-gray-700">Status ID</label>
                            <input type="text" name="status_id" id="status_id" value="{{ $catalog->status_id }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="county_name" class="block text-sm font-medium text-gray-700">County Name</label>
                            <input type="text" name="county_name" id="county_name" value="{{ $catalog->county_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="location_name" class="block text-sm font-medium text-gray-700">Location Name</label>
                            <input type="text" name="location_name" id="location_name" value="{{ $catalog->location_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="copy" class="block text-sm font-medium text-gray-700">Copy</label>
                            <input type="text" name="copy" id="copy" value="{{ $catalog->copy }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $catalog->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="text" name="price" id="price" value="{{ $catalog->price }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                            <textarea name="note" id="note" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $catalog->note }}</textarea>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">更新する</button>
                    </form>
                    <form id="delete-form" method="POST" action="{{ route('catalogs.destroy', $catalog->provider_id) }}" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="button" id="delete-button" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700">このカタログを削除する</button>
                    </form>

                    <!-- 削除確認オーバーレイ -->
                    <div id="delete-overlay" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <p class="mb-4 text-gray-800">本当に削除しますか？</p>
                            <div class="flex justify-end">
                                <button id="cancel-button" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 mr-2">いいえ</button>
                                <button id="confirm-button" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700">はい</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById('delete-button').addEventListener('click', function () {
                            document.getElementById('delete-overlay').classList.remove('hidden');
                        });

                        document.getElementById('cancel-button').addEventListener('click', function () {
                            document.getElementById('delete-overlay').classList.add('hidden');
                        });

                        document.getElementById('confirm-button').addEventListener('click', function () {
                            document.getElementById('delete-form').submit();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
