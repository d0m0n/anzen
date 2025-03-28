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
                            <div>
                                <select name="status_id" id="status_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" onchange="document.getElementById('filterForm').submit();">
                                    <option value="">在留資格を選択</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}" {{ request('status_id') == $status->id ? 'selected' : '' }}>
                                            {{ $status->residence_status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        <div class="flex items-center space-x-2">
                            <a href="{{ route('catalogs.index', array_merge(request()->except('sort'), ['sort' => 'price_asc'])) }}" class="text-blue-500 hover:text-blue-700">費用の安い順</a>
                            <span>|</span>
                            <a href="{{ route('catalogs.index', array_merge(request()->except('sort'), ['sort' => 'price_desc'])) }}" class="text-blue-500 hover:text-blue-700">費用の高い順</a>
                        </div>

                        <!-- クリアボタン -->
                        <a href="{{ route('catalogs.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700">クリア</a>
                    </div>
                    <!-- フィルタリングフォームとソートリンク終了 -->

                    @if (isset($providerName))
                        <div class="mb-4 text-lg font-semibold">
                            {{ $providerName }}が提供するカタログ
                        </div>
                    @endif

                    @if (isset($catalogs) && $catalogs->isNotEmpty())
                        @foreach ($catalogs as $catalog)
                            <div class="block mb-4 p-4 bg-gray-100 dark:bg-gray-200 rounded-lg">
                                @if ($catalog->country && $catalog->country->alpha2)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <img src="https://flagcdn.com/w40/{{ strtolower($catalog->country->alpha2) }}.png" alt="{{ $catalog->country->alpha2 }} flag" class="inline-block h-6">
                                            <span class="px-2 py-1 bg-gray-100 text-sm rounded">
                                                {{ $catalog->county_name }}
                                            </span>
                                            <span class="px-2 py-1 bg-gray-100 text-sm rounded">
                                                {{ $catalog->location_name }}
                                            </span>
                                            <span class="px-2 py-1 text-sm rounded 
                                                @if ($catalog->status->residence_status == '技能実習') bg-blue-200 
                                                @elseif ($catalog->status->residence_status == '特定技能') bg-emerald-200 
                                                @else bg-gray-400 
                                                @endif">
                                                {{ $catalog->status->residence_status ?? '不明' }}
                                            </span>
                                        </div>
                                        <span class="text-sm font-semibold">
                                            <strong>提供:</strong> 
                                            <a href="{{ route('catalogs.provider.list', ['provider_id' => $catalog->provider_id]) }}" class="text-blue-500 hover:text-blue-700">
                                                {{ $catalog->provider->name ?? '不明' }}
                                            </a>
                                        </span>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between mt-2">
                                    <p class="text-2xl font-bold">{{ $catalog->copy }}</p>
                                    <div class="flex items-center space-x-4">
                                        <p class="text-l font-bold"><strong>初期費用</strong></p>
                                        <p class="text-2xl font-bold">{{ number_format($catalog->price) }} 円</p>
                                        <a href="{{ route('catalogs.show', $catalog) }}" class="px-6 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-700">
                                            詳細はこちら
                                        </a>
                                    </div>
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
