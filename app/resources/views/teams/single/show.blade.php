<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('team.invite') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        @if ($datas->name)
                            <section class="py-4">
                                <h2>{{ __('team.invite_name') }} : {{ $datas->name }}</h2>
                                @if ($datas->users)
                                    <ul>
                                        @foreach ($datas->users as $people)
                                            <li>{{ $people->name }}</li>
                                        @endforeach
                                    </ul> 
                                @endif   
                            </section>
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
