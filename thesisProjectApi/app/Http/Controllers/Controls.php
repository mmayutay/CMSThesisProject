<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataRequests;
use App\Models\cms_members;
use App\Models\cms_users;
use App\Models\cms_accounts;
use App\Models\cms_userroles;
use App\Models\cms_attendance;
use App\Models\userrolesIDs;

class Controls extends Controller
{
    public function allUsersFromAdminToMember() {
        return cms_users::all();
    }
    public function cell(){
        return cms_userroles::all();
    }
    
    public function getUserInfo(Request $request) {
        $email = $request->input('Email');
        $userInfo = cms_members::where('Email', $email)
        ->get();
        return $userInfo;
    }

    public function getCell(Request $request) {
        
        $role = cms_users::where('leader', $request->input('leaderid'))->get();
        return $role;
    }

    public function getNetwork(Request $request) {
        $network = cms_userroles::where('roles', $request->input('role'))->get();

        return $network;
    }

    public function getRolesById(Request $request) {
        $userRoleFind = userrolesIDs::where('id', $request->input('id'))->get();
        return $userRoleFind;
    }

    public function returnMembersOfAGroup(Request $request) {
        $memberUsers = cms_users::where('leader', $request->input('leaderID'))->get();
        return $memberUsers;
    }

    
                             
}
