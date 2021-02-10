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
use App\Models\cms_vip_users;

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

    public function getCell(Request $request) {
        
        $role = cms_users::where('leader', $request->input('leaderid'))->get();
        return $role;
    }

    public function getNetwork(Request $request) {
        $network = cms_userroles::where('roles', $request->input('role'))->get();

        return $network;
    }

    public function getRolesById(Request $request) {
        $id = cms_userroles::where('id', $request->input('id'))->get();

        return $id;
    }

    public function getDay(Request $request) {
        $date = \Carbon\Carbon::now();
        // return now()->previous('Sunday')
        return $date->toRfc850String();
        // $userAttendance = new cms_attendance;
        // if ($request->date["date"] == now()->previous('Sunday')){
        //     $userAttendance->leader = $request->newUser["leader"];
        //     $userAttendance->member = $request->newUser["member"];
        //     $userAttendance->type = $request->newUser["type"];
        //     $userAttendance->date = $request->newUser["date"];
            // $userAttendance->save();
        //     return $userAttendance;
        // }else{
        //     return false;
        // }
        // $date = cms_attendances::where('date', now()->previous('Sunday'))->get();

        $mytime = \Carbon\Carbon::now();
        // return now()->previous('Sunday');
        return $mytime->toDateTimeString();
        // return $date;
    }

    public function attendanceCounter(Request $request) {
        $attendance = cms_vip_users::where('attendanceCounter', now()->previous('Sunday') == 4);

        return $attendance;
    }
                             
}
