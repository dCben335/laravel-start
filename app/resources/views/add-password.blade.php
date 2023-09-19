<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Landing Page</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="{{ URL::to('css/app.css') }}">
        <link rel="stylesheet" href="./css/add-password.module.css">

        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    </head>
    <body class="antialiased">
        <form action="{{ route('add-password') }}" method="POST">
            @csrf
            @method("POST")
            
            <div>
                <label>
                    <span>url du site</span>
                    <input type="text" name="url">
                </label>
                @error('url')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label>
                    <span>email</span>
                    <input type="email" name="email">
                </label>
    
                @error('email')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label>
                    <span>password</span>
                    <input type="password" name="pwd">
                </label>
    
                @error('pwd')
                    <small>{{ $message }}</small>
                @enderror
            </div>



            <button type="submit">Submit</button>          
        </form> 
    </body>
</html>
