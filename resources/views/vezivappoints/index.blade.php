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
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($vezivappoints as $appointment)
                <div class="p-6 flex space-x-2">
                    <div class="flex-1">
                        <div class="flex ">
                            <div class="mt-4 text-lg text-gray-900">
                                <strong>{{date("d/m/Y H:i",$appointment->app_date)}}</strong> <span>{{ $appointment->full_name }} {{ $appointment->phone }} {{ $appointment->email }}</span>
                                <form method="POST" action="{{ route('vezivappoint.destroy', $appointment) }}">
                                    @csrf
                                    @method('delete')
                                    <x-secondary-button onclick="event.preventDefault(); if(confirm('{{ __('Are you sure?') }}')){this.closest('form').submit();}" class="mt-4" >{{ __('Delete') }}</x-secondary-button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>