<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cms_users;
use App\Models\cms_accounts;
use App\Models\activeOrInactiveUsers;

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
            $findMemberExist->active = $request->input('active');
            // $findMemberExist->save();
            return $findMemberExist;
        }

    } 
}
