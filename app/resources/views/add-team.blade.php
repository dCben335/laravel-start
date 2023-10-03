<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Password') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('team.store') }}" method="POST">
                        @csrf
                        @method("POST")
                        
                        <div>
                            <label>
                                <span>Nom de la team</span>
                                <input type="text" name="name" class="text-gray-800">
                            </label>
                            @error('name')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

            
                        <button type="submit">Submit</button>          
                    </form> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

      

