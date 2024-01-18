
   
      
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

                    @if ("datas")
                        @foreach ($datas as $data)
                            <article class="py-4">
                                <h3>{{ __('team.show_name') }}  : 
                                    <a href="/teams/{{ $data->id }}/invite">{{ $data->name }}</a>
                                </h3>
                            </article>
                        @endforeach
                        @else 
                            <h2></h2>                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
        
              
        
        