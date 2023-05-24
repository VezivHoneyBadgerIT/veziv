<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        @if(session()->has('message'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
              {{ session()->get('message') }}
            </div>
        @endif
        @if(session()->has('message_err'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
              {{ session()->get('message_err') }}
            </div>
        @endif
        <form method="POST" action="{{ route('vezivadmin.update', $vezivadmin) }}">
            @csrf
            @method('patch')
            <label for="home_message">{{ __('Home Message') }}:</label>
            <textarea
                name="home_message"
                id="home_message"
                placeholder="{{ __('Home Message') }}"
                class="editorme"
            >{{ old('home_message', $vezivadmin->home_message) }}</textarea>
            <x-input-error :messages="$errors->get('home_message')" class="mt-2" />
            <br />
            <label for="show_days">{{ __('Show Days') }}:</label>
            <input type="number"
                min="1"
                placeholder="{{ 30 }}"
                name="show_days"
                id="show_days"
                value="{{ old('show_days', $vezivadmin->show_days) }}" />
            <x-input-error :messages="$errors->get('show_days')" class="mt-2" />
            <br /><br />
            <label for="apts_enabled">{{ __('Appointments Enabled') }}:</label>
            <input type="checkbox"
                name="apts_enabled"
                id="apts_enabled"
                value="1"
                @checked($vezivadmin->apts_enabled) />
            <x-input-error :messages="$errors->get('apts_enabled')" class="mt-2" />
            <br /><br />
            <label for="day1">{{ __('Monday') }}:</label>
            <input type="checkbox" class="mr-2"
                name="day1"
                id="day1"
                value="1"
                @checked($vezivadmin->day1) />
            <x-input-error :messages="$errors->get('day1')" class="mt-2" />
            <label for="day2">{{ __('Tuesday') }}:</label>
            <input type="checkbox" class="mr-2"
                name="day2"
                id="day2"
                value="1"
                @checked($vezivadmin->day2) />
            <x-input-error :messages="$errors->get('day2')" class="mt-2" />
            <label for="day3">{{ __('Wednesday') }}:</label>
            <input type="checkbox" class="mr-2"
                name="day3"
                id="day3"
                value="1"
                @checked($vezivadmin->day3) />
            <x-input-error :messages="$errors->get('day3')" class="mt-2" />
            <label for="day4">{{ __('Thursday') }}:</label>
            <input type="checkbox" class="mr-2"
                name="day4"
                id="day4"
                value="1"
                @checked($vezivadmin->day4) />
            <x-input-error :messages="$errors->get('day4')" class="mt-2" />
            <label for="day5">{{ __('Friday') }}:</label>
            <input type="checkbox" class="mr-2"
                name="day5"
                id="day5"
                value="1"
                @checked($vezivadmin->day5) />
            <x-input-error :messages="$errors->get('day5')" class="mt-2" />
            <br />
            <label for="day6">{{ __('Saturday') }}:</label>
            <input type="checkbox" class="mr-2"
                name="day6"
                id="day6"
                value="1"
                @checked($vezivadmin->day6) />
            <x-input-error :messages="$errors->get('day6')" class="mt-2" />
            <label for="day7">{{ __('Sunday') }}:</label>
            <input type="checkbox" class="mr-2"
                name="day7"
                id="day7"
                value="1"
                @checked($vezivadmin->day7) />
            <x-input-error :messages="$errors->get('day7')" class="mt-2" />
            <br /><br />
            <textarea
                name="apts_disabled_message"
                id="apts_disabled_message"
                placeholder="{{ __('Appointments disabled Message') }}"
                class="editorme"
            >{{ old('apts_disabled_message', $vezivadmin->apts_disabled_message) }}</textarea>
            <br />
            <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>