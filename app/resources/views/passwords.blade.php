
   
      
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-center">Password Page</h1>

                    @if ("datas")
                        @foreach ($datas as $data)
                            <article class="py-4">
                                <h3 >Site : {{ $data->site }}</h3>
                                <div>
                                    <p>login:  {{ $data->login }}</span></p>
                                    <p>password:  <a href="/change-password/{{ $data->id }}">{{ $data->password }}</a></span></p>
                                    <p>date d'ajout:  {{ $data->created_at }}</span></p>
                                    <p>date de MAJ:  {{ $data->updated_at }}</span></p>
                                </div>
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
        
              
        
        