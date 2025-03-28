<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $providerName }}が提供するカタログ
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- 追加: company_name, location, phone_number, fax_numberの表示 -->
                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-100 rounded-lg">
                        <p class="text-lg font-semibold"> {{ $company_name }}</p>
                        <p class="text-sm">所在地: {{ $location }}</p>
                        <p class="text-sm">電話番号: {{ $phone_number }}</p>
                        <p class="text-sm">FAX番号: {{ $fax_number }}</p>
                    </div>
                    <!-- ここまで追加 -->

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
