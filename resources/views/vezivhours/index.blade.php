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
        <form method="POST" action="{{ route('vezivhours.store') }}">
            @csrf
            <label for="start_time">{{ __('Start time') }}:</label>
            <input type="time"
                name="start_time"
                id="start_time"
                value="{{ old('start_time') }}" />
            <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
            <label for="start_time">{{ __('End time') }}:</label>
            <input type="time"
                name="end_time"
                id="end_time"
                value="{{ old('end_time') }}" />
            <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Add open hours') }}</x-primary-button>
        </form>

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($vezivhours as $open_hour)
                <div class="p-6 flex space-x-2">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <p class="mt-4 text-lg text-gray-900">
                                <span>{{ $open_hour->start_time }} - {{ $open_hour->end_time }}</span>
                                @if ($open_hour->user->is(auth()->user()))
                                <a class="w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="{{ route('vezivhours.edit', $open_hour) }}">{{ __('Edit open hour') }}</a>
                                <form method="POST" action="{{ route('vezivhours.destroy', $open_hour) }}">
                                    @csrf
                                    @method('delete')
                                    <x-secondary-button onclick="event.preventDefault(); if(confirm('{{ __('Are you sure?') }}')){this.closest('form').submit();}" class="mt-4" >{{ __('Delete') }}</x-secondary-button>
                                </form>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>