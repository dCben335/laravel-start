<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

 
class AddPasswordController extends Controller
{
    public function formValidation(Request $request)
    {
        $validated = $request->validate([
            'url' => 'required|string|url',
            'email' => 'required|string|email',
            'pwd' => 'required|string'
        ]);

        if ($validated) { 
            $jsonName = time();
            Storage::put("$jsonName-password.json", json_encode($validated));
        }

        return redirect('/');
    }

}


?>