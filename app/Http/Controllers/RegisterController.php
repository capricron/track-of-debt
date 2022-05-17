<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function store(Request $request){
        $validate = $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        $validate['password'] = Hash::make($validate['password']);
    
        // return $validate;
        User::create($validate);

        $request->session()->flash('success', 'Berhasil mendaftar silahkan login');

        return redirect('/login');
    }
}
