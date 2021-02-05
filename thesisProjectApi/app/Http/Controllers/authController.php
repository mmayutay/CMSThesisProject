<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\cms_users;
use App\Models\cms_leaders;
use App\Models\cms_accounts;
use App\Models\cms_userroles;
use App\Models\cms_members;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function login(Request $request) {
        $email=$request->input('username');
        $pass=$request->input('password');

        $userRequest=cms_accounts::where('username', $email)
        ->get();
        if(count($userRequest) == 0) {
            return $userRequest;
        }else {
            $partialPassword=$userRequest->pluck('password');
            $password=Crypt::decryptString($partialPassword[0]);
            if($password == $pass) {
                return $userRequest;
            }
            return false;
        }
    }
    public function signUp(Request $request) {
        $leader = new cms_leaders;
        $member = new cms_members;
        $user = new cms_users;
        $newAccountCreate = new cms_accounts;
        $userRole = new cms_userroles ;

        $user->lastname = $request->newUser["Lastname"];
        $user->firstname = $request->newUser["Firstname"];
        $user->birthday = $request->newUser["Birthday"];
        $user->age = $request->newUser["Age"];
        $user->address = $request->newUser["Address"];
        $user->marital_status = $request->newUser["Marital_status"];
        $user->email = $request->newUser["Email"];
        $user->contact_number = $request->newUser["Contact_number"];
        $user->facebook = $request->newUser["Facebook"];
        $user->instagram = $request->newUser["Instagram"];
        $user->twitter = $request->newUser["Twitter"];
        $user->leader = $request->groupBelong["Leader"];
        $user->category = "Asian";
        $user->isCGVIP = true;
        $user->isSCVIP = true;
        $user->auxilliary = "Romeo's Group";
        $user->ministries = "Romeo's Ministry";
        $user->save();

        $userRole->roles = $request->role["code"];
        $userRole->firstname = $request->newUser["Firstname"];
        $userRole->lastname = $request->newUser["Lastname"];
        $userRole->description = $request->newUser["Description"];

        $userRole->save();

        $newUserId=$userRole->id;

        $newAccountCreate->userid = $user->id;
        $newAccountCreate->username = 'BHCF'. $request->newUser["Firstname"][0] . $request->newUser["Lastname"] . $user->id;
        $newAccountCreate->password =  Crypt::encryptString($request->newUser["Lastname"] . 'Member' . $user->id);
        $newAccountCreate->roles = $newUserId;
        $newAccountCreate->save();

        // $leaderId= $request->id

        // $leader->$userid = $leaderid;
        return $leader;
        
        
        return $newAccountCreate;
    }
    
}   
