<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cms_attendance;
use App\Models\cms_users;
use App\Models\eventsAttendance;


class attendanceController extends Controller
{
    public function getDay(Request $request) {
        $userAttendance = new cms_attendance;
        $mytime = \Carbon\Carbon::now();
        $today= substr($mytime->toRfc850String(), 0, strrpos($mytime->toRfc850String(), ","));
        if ($today == 'Sunday'){
            $userAttendance->leader = $request->newUser["leader"];
            $userAttendance->member = $request->newUser["member"];
            $userAttendance->type = $request->newUser["type"];
            $userAttendance->date = $request->newUser["date"];
            $userAttendance->save();
            return $userAttendance;
        }else{
            return 'false';
        }
    }

    public function attendanceCounter(Request $request) {
        $attendance = cms_vip_users::where('attendanceCounter', now()->previous('Sunday') == 4);

        return $attendance;
    }

    public function viewAttendance(Request $request) {
        $arrayOfAttendance = array();

        $viewUserAttendance = cms_attendance::where('member', $request->input('currentUserId'))->get();
        $currentUserData = cms_users::where('id', $request->input('currentUserId'))->get();
        $currentUsersLeader = cms_users::where('id', $viewUserAttendance->pluck('leader')[0])->get();

        array_push($arrayOfAttendance, array('currentUserAttendance' => $viewUserAttendance->pluck('date'), 'currentUserData' => $currentUserData, 'currentUsersLeader' => $currentUsersLeader));


        return $arrayOfAttendance;
    }

    public function viewAttendanceSCandEvents(Request $request) {
        $arrayOfSCandEvents = array();

        $viewAttendance = cms_attendance::where('member', $request->input('currentUserId'))->get();
        $viewEventsAttendance = eventsAttendance::where('member', $request->input('currentUserId'))->get();
        array_push($arrayOfSCandEvents, array('currentUserAttendance' => $viewAttendance, 'currentEventsAttendance' => $viewEventsAttendance));

        return $arrayOfSCandEvents;
    }

    public function returnCurrentUserAttendance(Request $request) {
        $arrayOfYourThisMonthsAttendance = array();
        $currentUserAttendance = cms_attendance::where('member', $request->input('currentUserId'))->get();
        foreach ($currentUserAttendance->pluck('date') as $key => $value) {
            if(\str_contains($value, $request->input('month'))) {
                array_push($arrayOfYourThisMonthsAttendance, $value);
            }
        }

        return $arrayOfYourThisMonthsAttendance;
    }

    public function currentUsersAttendanceYear(Request $request) {
        $arrayForaSelectedYearAttendance = array();
        $currentUserAttendance = cms_attendance::where('member', $request->input('currentUserId'))->get();
        foreach ($currentUserAttendance->pluck('date') as $key => $value) {
            if (\str_contains($value, $request->input('year'))) {
                if(\str_contains($value, $request->input('month'))) {
                    array_push($arrayForaSelectedYearAttendance, $value);
                }
            }
        }
        return $arrayForaSelectedYearAttendance;
    }

    public function viewCellAttendance(Request $request) {

        $dateSelect = $request->input("dateOption");

        $arrayCellAttendance = array();
        $cellMember = cms_users::where('leader', $request->input('currentUserId'))->get()->count();
        // $cellAttendance = cms_attendance::select(*)
        //                                     ->where('leader', $request->input('currentUserId'))
        //                                     ->where('date',  )
        //                                     ->get();
        
        $dateAttendance = cms_attendance::pluck('date');
        // foreach ($dateAttendance as $key => $value) {
        //     if(){
        //     }
        // }


        

        // foreach ($variable as $key => $value) {
        //     if()
        // }
        // return $cellAttendance;
        // return $cellMember;
        // $cellAttendanceCount = $totalCellAttendance/$cellAttendance;


        
    }

    public function attendanceCellGroup(Request $request) {
        $attendaceArray = array();

        $cellAttendance = cms_attendance::where('member', $request->input('currentUserId'))->get();

        for ($i=0; $i < count($cellAttendance); $i++) { 
            array_push($attendaceArray, $i);
        }

        return $attendaceArray;
    }

}
