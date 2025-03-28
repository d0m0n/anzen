<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <!-- 新規作成ボタン -->
                <a href="{{ route('catalogs.create') }}" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-700">
                    新規作成
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (isset($catalogs) && $catalogs->isNotEmpty())
                        @foreach ($catalogs as $catalog)
                            <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-200 rounded-lg">
                                <p><strong>Provider Name:</strong> {{ $catalog->provider->name ?? '不明' }}</p>
                                <p><strong>Status ID:</strong> {{ $catalog->status_id }}</p>
                                <p><strong>County Name:</strong> {{ $catalog->county_name }}</p>
                                <p><strong>Location Name:</strong> {{ $catalog->location_name }}</p>
                                <p><strong>Copy:</strong> {{ $catalog->copy }}</p>
                                <p><strong>Price:</strong> {{ $catalog->price }}</p>
                                <a href="{{ route('catalogs.show', $catalog) }}" class="text-blue-500 hover:text-blue-700">詳細を見る</a>
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
