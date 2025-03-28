<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('ユーザー詳細の更新') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('会社情報と連絡先情報を更新してください。') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update.details') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="company_name" :value="__('会社名')" />
            <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" :value="old('company_name', auth()->user()->company_name)" />
            <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
        </div>

        <div>
            <x-input-label for="location" :value="__('所在地')" />
            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', auth()->user()->location)" />
            <x-input-error class="mt-2" :messages="$errors->get('location')" />
        </div>

        <div>
            <x-input-label for="phone_number" :value="__('電話番号')" />
            <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" :value="old('phone_number', auth()->user()->phone_number)" />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>

        <div>
            <x-input-label for="fax_number" :value="__('FAX番号')" />
            <x-text-input id="fax_number" name="fax_number" type="text" class="mt-1 block w-full" :value="old('fax_number', auth()->user()->fax_number)" />
            <x-input-error class="mt-2" :messages="$errors->get('fax_number')" />
        </div>

        <div>
            <x-input-label for="url" :value="__('URL')" />
            <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" :value="old('url', auth()->user()->url)" />
            <x-input-error class="mt-2" :messages="$errors->get('url')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('保存') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('保存しました。') }}</p>
            @endif
        </div>
    </form>
</section>
