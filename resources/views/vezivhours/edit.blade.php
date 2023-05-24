<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('vezivhours.update', $vezivhour) }}">
            @csrf
            @method('patch')

            <label for="start_time">{{ __('Start time') }}:</label>
            <input type="time"
                name="start_time"
                id="start_time"
                value="{{ old('start_time', $vezivhour->start_time) }}" />
            <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
            <label for="start_time">{{ __('End time') }}:</label>
            <input type="time"
                name="end_time"
                id="end_time"
                value="{{ old('end_time', $vezivhour->end_time) }}" />
            <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('vezivhours.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>