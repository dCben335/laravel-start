<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('team.invite') }}
        </h2>
    </x-slot>


    @if ($datas)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
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
                        
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($passwords)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <section>
                            <h2>{{ __('team.invite_passwords') }}</h2>
                            @foreach ($passwords as $data)
                                <article class="py-4">
                                    <h3 >Site : {{ $data->site }}</h3>
                                    <div>
                                        <p>{{  __('password.show_url') }}:  {{ $data->login }}</p>
                                        <p>{{  __('password.show_password') }}: {{ $data->password }}</p>
                                        <p>{{  __('password.show_creation') }}:  {{ $data->created_at }}</p>
                                        <p>{{  __('password.show_update') }}:  {{ $data->updated_at }}</p>
                                    </div>
                                </article>
                            @endforeach
                        </section>               
                    </div>
                </div>
            </div>
        </div>                
    @endif
    @if ($peoples)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <section class="py-4">                            
                            <form action="{{ route('team.invite', $id) }}" method="POST">
                                @csrf
                                <select name="person-to-invite" class="text-gray-900">
                                    @foreach ($peoples as $people)
                                        <option value="{{ $people->id }}">{{ $people->name }}</option>
                                    @endforeach
                                </select>
                                @error('person-to-invite')
                                    <small>Error</small>
                                @enderror
                                <button type="submit">{{ __('team.invite_submit_button') }}</button>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>      
    @endif
</x-app-layout>
