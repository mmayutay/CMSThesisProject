<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataRequests;
use App\Models\cms_members;
use App\Models\cms_users;
use App\Models\cms_accounts;
use App\Models\cms_userroles;


class Controls extends Controller
{
    public function list() {
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

    public function getLeader() {
        
        $role = cms_userroles::where('roles', "Leader")->get();

        return $role;
    }

    public function getMember() {
        $cell = cms_userroles::where('roles', "Member")->get();

        return $cell;
    }
                             
}
