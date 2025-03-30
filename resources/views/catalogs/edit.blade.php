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
                        <input type="hidden" name="provider_id" value="{{ $catalog->provider_id }}">
                        <div class="mb-4">
                            <x-input-label for="status_id" :value="__('在留資格')" />
                            <select name="status_id" id="status_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="" disabled selected>在留資格を選んでください</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" {{ $catalog->status_id == $status->id ? 'selected' : '' }}>
                                        {{ $status->residence_status }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status_id')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="county_name" :value="__('国名')" />
                            <x-text-input id="county_name" name="county_name" type="text" class="mt-1 block w-full" value="{{ $catalog->county_name }}" placeholder="国名を入力してください" />
                            <x-input-error :messages="$errors->get('county_name')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="location_name" :value="__('地域名')" />
                            <x-text-input id="location_name" name="location_name" type="text" class="mt-1 block w-full" value="{{ $catalog->location_name }}" placeholder="地域名を入力してください" />
                            <x-input-error :messages="$errors->get('location_name')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="copy" :value="__('見出し')" />
                            <x-text-input id="copy" name="copy" type="text" class="mt-1 block w-full" value="{{ $catalog->copy }}" placeholder="見出しを入力してください" />
                            <x-input-error :messages="$errors->get('copy')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('詳細情報')" />
                            <textarea id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="詳細情報を入力してください">{{ $catalog->description }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="price" :value="__('初期費用')" />
                            <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" value="{{ $catalog->price }}" placeholder="初期費用を入力してください" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="note" :value="__('備考')" />
                            <textarea id="note" name="note" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="備考を入力してください（任意）">{{ $catalog->note }}</textarea>
                            <x-input-error :messages="$errors->get('note')" class="mt-2" />
                        </div>
                        <div class="flex justify-between items-center">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">更新する</button>
                            <form id="delete-form" method="POST" action="{{ route('catalogs.destroy', $catalog->provider_id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="delete-button" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700">このカタログを削除する</button>
                            </form>
                        </div>
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
