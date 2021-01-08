<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cms_members;

class authController extends Controller
{
    public function login(Request $request) {
        $email=$request->input('email');
        $password=$request->input('password');
        
        $userRequest=cms_members::where('Email', $email)
        ->where('Password', $password)
        ->get();

        return $userRequest;
    }
    public function signUp(Request $request) {
        $user = new cms_members;

        $user->age = $request->input('Age');
        $user->leader = $request->input('Leader');
        $user->member_status = $request->input('Member_status');
        $user->email = $request->input('Email');
        $user->name = $request->input('Name');
        $user->password = $request->input('Password');
        $user->save();
        return $user;
    }
}
