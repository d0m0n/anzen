<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- 新規作成フォーム -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <button id="toggle-form" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">新規作成</button>
                    <div id="create-form" class="hidden mt-4">
                        <form method="POST" action="{{ route('catalogs.store') }}">
                            @csrf
                            <input type="hidden" name="provider_id" value="{{ auth()->id() }}">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <x-input-label for="status_id" :value="__('在留資格')" />
                                    <select name="status_id" id="status_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                        <option value="" disabled selected>在留資格を選んでください</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->residence_status }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('status_id')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="county_name" :value="__('国名')" />
                                    <x-text-input id="county_name" name="county_name" type="text" class="mt-1 block w-full" placeholder="国名を入力してください" />
                                    <x-input-error :messages="$errors->get('county_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="location_name" :value="__('地域名')" />
                                    <x-text-input id="location_name" name="location_name" type="text" class="mt-1 block w-full" placeholder="地域名を入力してください"/>
                                    <x-input-error :messages="$errors->get('location_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="copy" :value="__('見出し')" />
                                    <x-text-input id="copy" name="copy" type="text" class="mt-1 block w-full" placeholder="見出しを入力してください"/>
                                    <x-input-error :messages="$errors->get('copy')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="description" :value="__('詳細情報')" />
                                    <textarea id="description" name="description" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="詳細情報を入力してください"></textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="price" :value="__('初期費用')" />
                                    <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" placeholder="初期費用を入力してください"/>
                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="note" :value="__('備考')" />
                                    <textarea id="note" name="note" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="備考を入力してください（任意）"></textarea>
                                    <x-input-error :messages="$errors->get('note')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex justify-end mt-4">
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-700">このカタログを新規登録する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- 既存のカタログ表示 -->
            <div class="flex justify-end mb-4">
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (isset($catalogs) && $catalogs->isNotEmpty())
                        @foreach ($catalogs->filter(fn($catalog) => $catalog->provider_id === auth()->id()) as $catalog)
                            <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-200 rounded-lg">
                                <p><strong>Provider Name:</strong> {{ $catalog->provider->name ?? '不明' }}</p>
                                <p><strong>Residence Status:</strong> {{ $catalog->status->residence_status ?? '不明' }}</p>
                                <p><strong>County Name:</strong> {{ $catalog->county_name }}</p>
                                <p><strong>Location Name:</strong> {{ $catalog->location_name }}</p>
                                <p><strong>Copy:</strong> {{ $catalog->copy }}</p>
                                <p><strong>Price:</strong> {{ $catalog->price }}</p>
                                <div class="mt-2">
                                    <button class="px-3 py-1 bg-gray-500 text-white rounded-md hover:bg-gray-700 text-sm" onclick="location.href='{{ route('catalogs.edit', $catalog) }}'">この内容を修正する</button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>カタログデータがありません。</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('toggle-form').addEventListener('click', function () {
        const form = document.getElementById('create-form');
        form.classList.toggle('hidden');
    });
</script>
