<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('カタログ一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- フィルタリングフォームとソートリンク -->
                    <div class="flex items-center space-x-4 mb-4">
                        <form method="GET" action="{{ route('catalogs.index') }}" id="filterForm" class="flex items-center space-x-4">
                            <div>
                                <select name="country_name" id="country_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" onchange="document.getElementById('filterForm').submit();">
                                    <option value="">国名を選択</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country }}" {{ request('country_name') == $country ? 'selected' : '' }}>
                                            {{ $country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <select name="location_name" id="location_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" onchange="document.getElementById('filterForm').submit();">
                                    <option value="">地域名を選択</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location }}" {{ request('location_name') == $location ? 'selected' : '' }}>
                                            {{ $location }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        <div class="flex items-center space-x-2">
                            <a href="{{ route('catalogs.index', array_merge(request()->except('sort'), ['sort' => 'price_asc'])) }}" class="text-blue-500 hover:text-blue-700">価格の安い順</a>
                            <span>|</span>
                            <a href="{{ route('catalogs.index', array_merge(request()->except('sort'), ['sort' => 'price_desc'])) }}" class="text-blue-500 hover:text-blue-700">価格の高い順</a>
                        </div>

                        <!-- クリアボタン -->
                        <a href="{{ route('catalogs.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700">クリア</a>
                    </div>
                    <!-- フィルタリングフォームとソートリンク終了 -->

                    @if (isset($catalogs) && $catalogs->isNotEmpty())
                        @foreach ($catalogs as $catalog)
                            <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-200 rounded-lg">
                                <p><strong>Provider Name:</strong> {{ $catalog->provider->name ?? '不明' }}</p>
                                <p><strong>Residence Status:</strong> {{ $catalog->status->residence_status ?? '不明' }}</p>
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
