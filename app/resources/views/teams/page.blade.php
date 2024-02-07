
 
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('team.show') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <h1 class="text-center"> {{ __('team.show') }} </h1>

                    @if ($datas->count() > 0)
                        @foreach ($datas as $data)
                            <article class="py-4 relative">
                                <a href="{{ route("team.invitation", $data->id) }}" class="absolute right-0">{{ __('team.show_edit') }}</a>
                                <h3>{{ __('team.show_name') }} : {{ $data->name }}</h3>
                            </article>
                        @endforeach
                        @else 
                            <h2>{{ __('team.show_no_teams') }}</h2>                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
        
              
        
        