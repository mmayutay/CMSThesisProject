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
use App\Models\cmsVipUsers;
use App\Models\userrolesIDs;

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
        $user = new cms_users;
        $newAccountCreate = new cms_accounts;
        $userRole = new cms_userroles;
        $vipUsers = new cmsVipUsers;
        $userRolesId = new userrolesIDs;

        $user->lastname = $request->newUser["Lastname"];
        $user->firstname = $request->newUser["Firstname"];
        $user->birthday = $request->newUser["Birthday"];
        $user->age = $request->newUser["Age"];
        $user->gender = $request->newUser["Gender"];
        $user->address = $request->newUser["Address"];
        $user->marital_status = $request->newUser["Marital_status"];
        $user->email = $request->newUser["Email"];
        $user->contact_number = $request->newUser["Contact_number"];
        $user->facebook = $request->newUser["Facebook"];
        $user->instagram = $request->newUser["Instagram"];
        $user->twitter = $request->newUser["Twitter"];
        $user->leader = $request->groupBelong["Leader"];
        $user->category = "Asian";
        $user->isCGVIP = $request->newUser["isCGVIP"];
        $user->isSCVIP = $request->newUser["isSCVIP"];
        $user->auxilliary = "Romeo's Group";
        $user->ministries = "Romeo's Ministry";
        $user->save();
        // return $user;

        $userRole->roles = $request->role["code"];
        $userRole->firstname = $request->newUser["Firstname"];
        $userRole->lastname = $request->newUser["Lastname"];
        $userRole->description = $request->newUser["Description"];

        $userRole->save();

        $roleIds = userrolesIDs::all();
        foreach ($roleIds as $key => $value) {
            if($request->role["code"] == $value->roles){
                $userRole->roles = $value->id;
                $userRole->firstname = $request->newUser["Firstname"];
                $userRole->lastname = $request->newUser["Lastname"];
                $userRole->description = $request->newUser["Description"];
                $userRole->save();  
            }
        }

        if($request->newUser["isCGVIP"] == "true" && $request->newUser["isSCVIP"] == "true") {
            $vipUsers->leaderId = $request->groupBelong["Leader"];
            $vipUsers->userId = $user->id;
            $vipUsers->attendanceCounter = 0;
            $vipUsers->save();
        }

        $newAccountCreate->userid = $user->id;
        $newAccountCreate->username = 'BHCF'. $request->newUser["Firstname"][0] . $request->newUser["Lastname"] . $user->id;
        $newAccountCreate->password =  Crypt::encryptString($request->newUser["Lastname"] . 'Member' . $user->id);
        $newAccountCreate->roles = $userRole->roles;
        $newAccountCreate->save();
        return $newAccountCreate;
    }
    
}   