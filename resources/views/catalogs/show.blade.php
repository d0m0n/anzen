<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('カタログ詳細') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- 提供社情報 -->
                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-100 rounded-lg">
                        <p class="text-lg font-semibold"> {{ $company_name }}</p>
                        <p class="text-sm">所在地: {{ $location }}</p>
                        <p class="text-sm">電話番号: 
                            <a href="tel:{{ $phone_number }}" class="text-blue-500 hover:text-blue-700">{{ $phone_number }}</a>
                        </p>
                        <p class="text-sm">FAX番号: {{ $fax_number }}</p>
                        <p class="text-sm">ホームページ:
                                <a href="{{ $url }}" target="_blank" class="text-blue-500 hover:text-blue-700">{{ $url }}</a>
                        </p>
                    </div>
                    <!-- カタログ情報 -->
                    <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-200 rounded-lg">
                        <p><strong>Provider Name:</strong> {{ $catalog->provider->name }}</p>
                        <p><strong>Residence Status:</strong> {{ $catalog->status->residence_status ?? '不明' }}</p>
                        <p><strong>County Name:</strong> {{ $catalog->county_name }}</p>
                        <p><strong>Location Name:</strong> {{ $catalog->location_name }}</p>
                        <p><strong>Copy:</strong> {{ $catalog->copy }}</p>
                        <p><strong>Description:</strong> {{ $catalog->description }}</p>
                        <p><strong>Price:</strong> {{ $catalog->price }}</p>
                        <p><strong>Note:</strong> {{ $catalog->note }}</p>
                    </div>
                    <a href="javascript:history.back()" class="text-blue-500 hover:text-blue-700">戻る</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
