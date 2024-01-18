
   
      
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('password.show') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-center">{{ __('password.show') }}</h1> 
                    <a href="{{ route('password.download') }}"><strong>{{ __('password.show_download') }}</strong></a>
                    

                </div>
            </div>
        </div>
    </div>
  
    
    @if ("datas")
        @foreach ($datas as $data)
            <div class="py-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <article class="py-4 relative">
                                <a href="/passwords/{{ $data->id }}/update" class="absolute right-0">{{  __('password.show_edit') }}</a>
                                <h3 class="pb-6 text-xl">{{  __('password.show_url') }} : {{ $data->site }}</h3>
                                <div>
                                    <p>{{  __('password.show_login') }}:  {{ $data->login }}</span></p>
                                    <p>{{  __('password.show_password') }}: {{ $data->password }}</p>
                                    <p>{{  __('password.show_creation') }}:  {{ $data->created_at }}</p>
                                    <p>{{  __('password.show_update') }}:  {{ $data->updated_at }}</p>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</x-app-layout>
        
              
        
        