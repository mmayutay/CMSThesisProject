<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cms_users;
use App\Models\cms_accounts;
use App\Models\activeOrInactiveUsers;
use App\Models\userrolesIDs;

class findActiveAndInactiveUsers extends Controller
{
    public function returnAllMembers() {
        $allMembersUsers = cms_accounts::where('roles', 4)->get();
        return $allMembersUsers->pluck('userid');
    }

    public function userInactive(Request $request) {
        $userInactive = new activeOrInactiveUsers;

        $findMemberExist = activeOrInactiveUsers::where('userId', $request->input('memberId'))->get();
        if(count($findMemberExist) == 0) {
            $userInactive->userId = $request->input('memberId');
            $userInactive->active = $request->input('active');
            $userInactive->save();
            return $userInactive;
        }else {
            $findMemberExist[0]->active = $request->input('active');
            $findMemberExist[0]->save();
            return $findMemberExist;
        }

    } 

    public function getInactiveUsers($boolean) {
        $arrayOfUsers = array();
        $getAllUsers = activeOrInactiveUsers::where('active', $boolean)->get();
        if(count($getAllUsers) != 0) {
            foreach ($getAllUsers->pluck('userId') as $key => $value) {
                array_push($arrayOfUsers, cms_users::where('id', $value)->get()[0]);
            }
            return $arrayOfUsers;
        }
        return $arrayOfUsers;
    }

    // public function insertDataForUserRoles() {
    //     $useRoles = new userrolesIDs;

    //     $useRoles->roles = "Member";
    //     $useRoles->save();
    //     return $useRoles;
        
    // }
}
