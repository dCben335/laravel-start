<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('password.store') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('password.stored') }}" method="POST">
                        @csrf
                        @method("POST")
                        
                        <div>
                            <label>
                                <span>{{  __('password.store_url') }}</span>
                                <input type="text" name="url" class="text-gray-800">
                            </label>
                            @error('url')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <label>
                                <span>{{  __('password.store_login') }}</span>
                                <input type="text" name="login" class="text-gray-800">
                            </label>
                
                            @error('login')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <label>
                                <span>{{  __('password.store_password') }}</span>
                                <input type="password" name="pwd" class="text-gray-800">
                            </label>
                
                            @error('pwd')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
            
                        <button type="submit">{{ __('password.store_submit_button') }}</button>          
                    </form> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

      

