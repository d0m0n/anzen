<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('カタログ一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($catalogs as $catalog)
                        <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-200 rounded-lg">
                            <p><strong>Provider Name:</strong> {{ $catalog->provider->name }}</p>
                            <p><strong>Status ID:</strong> {{ $catalog->status_id }}</p>
                            <p><strong>County Name:</strong> {{ $catalog->county_name }}</p>
                            <p><strong>Location Name:</strong> {{ $catalog->location_name }}</p>
                            <p><strong>Copy:</strong> {{ $catalog->copy }}</p>
                            <p><strong>Price:</strong> {{ $catalog->price }}</p>
                            <a href="{{ route('catalogs.show', $catalog) }}" class="text-blue-500 hover:text-blue-700">詳細を見る</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
