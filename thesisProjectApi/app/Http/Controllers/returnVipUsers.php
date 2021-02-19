<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cmsVipUsers;
use App\Models\cms_users;


class returnVipUsers extends Controller
{
    public function retrieveAllVipUsers() {
        $list = array();

        $allVipUsers = cmsVipUsers::all();
        foreach ($allVipUsers->pluck('userId') as $key => $value) {
            $foundUser = cms_users::where('id', $value)->get();
            array_push($list, $foundUser[0]);
        }

        return $list;

    }

    public function retrieveVipUsersWithLeader() {
        $array = array();

        $allVipUsers = cmsVipUsers::all();
        foreach ($allVipUsers->pluck('userId') as $key => $value) {
            $vipUser = cms_users::where('id', $value)->get();
            foreach ($allVipUsers->pluck('leaderId') as $key => $j) {
                $leader = cms_users::where('id', $j)->get();
            }
            array_push($array, array('leader' => $leader[0], 'member' => $vipUser[0]));
        }
        return $array;
    }

    public function allRecordedNewMember() {
        $array = array();

        $allNewConfirmedMember = cmsVipUsers::where('attendanceCounter', '>=', 4)->get();

        if($allNewConfirmedMember->isEmpty()) {
            return 'false';
        }
        foreach ($allNewConfirmedMember->pluck('userId') as $key => $value) {
            $vipUser = cms_users::where('id', $value)->get();
            foreach ($allNewConfirmedMember->pluck('leaderId') as $key => $j) {
                $leader = cms_users::where('id', $j)->get();
            }
            array_push($array, array('leader' => $leader[0], 'member' => $vipUser[0]));
        }
        return $array;
    }
}
