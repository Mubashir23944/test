<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(){
        User::create([
            'name' => 'Biker10',
            'email' => 'biker10@gmail.com ',
            'password' => Hash::make('secret'),
            'role_id' => 2,

        ]);
        return 'inserted';
    }
}
