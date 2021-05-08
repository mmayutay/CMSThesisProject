<?php

namespace App\Http\Controllers;

use App\Models\cms_accounts;
use App\Models\cms_attendance;
use App\Models\cms_users;
use App\Models\eventsAttendance;
use Illuminate\Http\Request;

class attendanceController extends Controller
{
    public function getDay(Request $request)
    {
        $userAttendance = new cms_attendance;
        $mytime = \Carbon\Carbon::now();
        $today = substr($mytime->toRfc850String(), 0, strrpos($mytime->toRfc850String(), ","));
        if ($today == 'Sunday') {
            $userAttendance->leader = $request->newUser["leader"];
            $userAttendance->member = $request->newUser["member"];
            $userAttendance->type = $request->newUser["type"];
            $userAttendance->date = $request->newUser["date"];
            $userAttendance->save();
            return $userAttendance;
        } else {
            return 'false';
        }
    }

    public function attendanceCounter(Request $request)
    {
        $attendance = cms_vip_users::where('attendanceCounter', now()->previous('Sunday') == 4);

        return $attendance;
    }

    public function viewAttendance(Request $request)
    {
        $arrayOfAttendance = array();

        $viewUserAttendance = cms_attendance::where('member', $request->input('currentUserId'))->get();
        $currentUserData = cms_users::where('id', $request->input('currentUserId'))->get();
        $currentUsersLeader = cms_users::where('id', $viewUserAttendance->pluck('leader')[0])->get();

        array_push($arrayOfAttendance, array('currentUserAttendance' => $viewUserAttendance->pluck('date'), 'currentUserData' => $currentUserData, 'currentUsersLeader' => $currentUsersLeader));

        return $arrayOfAttendance;
    }

    public function viewAttendanceSCandEvents(Request $request)
    {
        $arrayOfSCandEvents = array();

        $viewAttendance = cms_attendance::where('member', $request->input('currentUserId'))->get();
        $viewEventsAttendance = eventsAttendance::where('member', $request->input('currentUserId'))->get();
        array_push($arrayOfSCandEvents, array('currentUserAttendance' => $viewAttendance, 'currentEventsAttendance' => $viewEventsAttendance));

        return $arrayOfSCandEvents;
    }

    public function returnCurrentUserAttendance(Request $request)
    {
        $arrayOfYourThisMonthsAttendance = array();
        $currentUserAttendance = cms_attendance::where('member', $request->input('currentUserId'))->get();
        foreach ($currentUserAttendance->pluck('date') as $key => $value) {
            if (\str_contains($value, $request->input('month'))) {
                array_push($arrayOfYourThisMonthsAttendance, $value);
            }
        }

        return $arrayOfYourThisMonthsAttendance;
    }

    public function currentUsersAttendanceYear(Request $request)
    {
        $arrayForaSelectedYearAttendance = array();
        $currentUserAttendance = cms_attendance::where('member', $request->input('currentUserId'))->get();
        foreach ($currentUserAttendance->pluck('date') as $key => $value) {
            if (\str_contains($value, $request->input('year'))) {
                if (\str_contains($value, $request->input('month'))) {
                    array_push($arrayForaSelectedYearAttendance, $value);
                }
            }
        }
        return $arrayForaSelectedYearAttendance;
    }

    public function viewCellAttendance(Request $request)
    {
        $selectDate = $request->input('dateOption');
        $arrayOfDate = array();
        $arrayCellAttendance = array();
        $cellMember = cms_users::where('leader', $request->input('currentUserId'))->get()->count();

        $dateAttendance = cms_attendance::where('leader', $request->input('currentUserId'))->get();
        $count = count($dateAttendance);
        $holder = [];
        // return $count;
        // return $dateAttendance;

        // return $arrayCellAttendance;
        for ($i = 0; $i < $count; $i++) {
            $holder = $dateAttendance[$i];
            $dateAttendance[$i + 1];
            return $holder;
        }
    }

    public function returnRegularMembers($code)
    {
        $arrayOfRegularUsers = array();

        $roles = cms_accounts::where('roles', $code)->get()->pluck('userid');
        foreach ($roles as $key => $value) {
            $member = cms_users::select('*')
                ->where("id", $value)
                ->where("isCGVIP", 0)
                ->where("isSCVIP", 0)
                ->get();
                error_log($value);

            if(count($member) != 0) {
                array_push($arrayOfRegularUsers, $member[0]);
            }

        }
        return $arrayOfRegularUsers;
    }

    public function returnEventsandSC(Request $request){
        
        $arrayOfSCandEvents = array();

        $viewAttendance = cms_attendance::where('leader', $request->input('currentUserId'))->get();
        $viewEventsAttendance = eventsAttendance::where('leader', $request->input('currentUserId'))->get();
        array_push($arrayOfSCandEvents, array('currentUserAttendance' => $viewAttendance, 'currentEventsAttendance' => $viewEventsAttendance));

        return $arrayOfSCandEvents;
    }

    public function returnWeeklyAttendance(Request $request) {
        $arrayWeeklyAttendance = array();
        $arrayYearlyAttendance = array();
        $arrayCGandSC = array();
        $arrayQuarterlyAttendance = array();

        $sundayAttendance = cms_attendance::where('leader', $request->input('currentUserId'))->get();
        $eventsAttendance = eventsAttendance::where('leader', $request->input('currentUserId'))->get();


        //Sunday Celebration
        foreach ($sundayAttendance->pluck('date') as $key => $value) {
            // if ($today == 'Sunday'){
                $choice = $request->input("choice");
                if($choice == "monthly") {
                    if (\str_contains($value, $request->input('month'))) {
                    array_push($arrayWeeklyAttendance, $value);
                    return $arrayWeeklyAttendance;
                    }
                }
            
                if($choice == "yearly") {
                    if (\str_contains($value, $request->input('year'))) {
                        array_push($arrayYearlyAttendance, $value);
                        return $arrayYearlyAttendance;
                    }
                }

                if($choice == "quarterly") {
                    if(\str_contains($value, $request->input('1','2','3','4'))) {
                        array_push($arrayQuarterlyAttendance, $value);
                        return $arrayQuarterlyAttendance;
                    }
                } 
            // }
        }
         
        //Events Attendance
        foreach ($eventsAttendance->pluck('date') as $key => $value) {
                $choice = $request->input("choice");
                if($choice == "monthly") {
                    if (\str_contains($value, $request->input('month'))) {
                        array_push($arrayWeeklyAttendance, $value);
                        return $arrayWeeklyAttendance;
                    }
                }
                
                if($choice == "yearly") {
                    if (\str_contains($value, $request->input('year'))) {
                        array_push($arrayYearlyAttendance, $value);
                        return $arrayYearlyAttendance;
                    }
                }

                if($choice == "quarterly") {
                    if(\str_contains($value, $request->input('1','2','3','4'))) {
                        array_push($arrayQuarterlyAttendance, $value);
                        return $arrayQuarterlyAttendance;
                    }
                }
        }  
        // array_push($arrayCGandSC, array('SundayCelebration' => $sundayAttendance, 'EventsAttendance' => $eventsAttendance));
        // return $arrayCGandSC;
    }
}