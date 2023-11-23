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
                    @if ($peoples)
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
                    @else
                        <div>
                            <p>{{ __('team.invite_no_user') }}</p>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
