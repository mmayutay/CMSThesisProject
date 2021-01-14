<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\cms_members;
use App\Models\cms_leaders;

class authController extends Controller
{
    public function login(Request $request) {
        $email=$request->input('email');
        $pass=$request->input('password');
        
        $userRequest=cms_members::where('Email', $email)
        ->get();

        $partialPassword=$userRequest->pluck('password');
        $password=Crypt::decryptString($partialPassword[0]);
        if($password == $pass) {
            return $userRequest;
        }
        return false;
    }
    public function signUp(Request $request) {
        $leader = new cms_leaders;
        $user = new cms_members;

        $user->age = $request->input('Age');
        $user->leader = $request->input('Leader');
        $user->member_status = $request->input('Member_status');
        $user->email = $request->input('Email');
        $user->name =  $request->input('Name');
        $user->password = Crypt::encryptString($request->input('Password'));
        $user->save();
        if($user->member_status == "leader") {
            $leader->user_id = $user->id;
            $leader->pools_id = 1;
            $leader->level = "3";
            $leader->save();
        }
        
        return $leader;
    }
}
