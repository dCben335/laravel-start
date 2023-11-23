<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('password.update') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ("datas")
                        <article class="py-4">
                            <h3>{{ __('password.update_site') }} : {{ $datas->site }}</h3>
                            <div>
                                <p>{{ __('password.update_login') }} :  {{ $datas->login }}</span></p>
                                
                                <form action="{{ route('password.updatePwd', $datas->id) }}" method="POST">
                                    @csrf                                    

                                    <div>
                                        <label>
                                            <span>{{ __('password.update_new-password') }}</span>
                                            <input type="password" name="newpwd" class="text-gray-800">
                                        </label>
                                        @error('newpwd')
                                            <small>{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button type="submit">{{ __('password.update_submit_button') }}</button>          
                                </form> 
                            </div>
                        </article>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if ("teams")
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">        
                        <form action="{{ route('password.updateTeam', $datas->id) }}" method="POST">
                            @csrf                                    

                            @foreach ($teams as $team)
                                <label>
                                    <span>{{ $team->name }}</span>
                                    <input type="checkbox" value="{{ $team->id }}">
                                </label>
                                @error($team->id)
                                    <small>{{ $message }}</small>
                                @enderror
                            @endforeach
                
                            <button type="submit">{{ __('password.update_submit_button') }}</button>          
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
