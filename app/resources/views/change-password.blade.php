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
                    <h1>Changez votre mot de passe</h1>
                    @if ("datas")
                    <article class="py-4">
                        <h3>Site : {{ $datas->site }}</h3>
                        <div>
                            <p>login:  {{ $datas->login }}</span></p>
                            
                            <form action="{{ route('password.updated', $datas->id) }}" method="POST">
                                @csrf
                                @method("POST")
                                

                                <div>
                                    <label>
                                        <span>new password</span>
                                        <input type="password" name="newpwd" class="text-gray-800">
                                    </label>
                                    @error('newpwd')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
        
                    
                                <button type="submit">Submit</button>          
                            </form> 
                        </div>
                    </article>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
