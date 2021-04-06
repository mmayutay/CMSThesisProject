<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\eventsAndAnnouncements;
use App\Models\eventsAttendance;

class AttendanceEventAndSunday extends Controller
{
    public function addAttendanceInSCorEvents(Request $request) {
        $memberAttendance = new eventsAttendance;
        $memberAttendance->leader = $request->input('leader');
        $memberAttendance->member = $request->input('member');
        $memberAttendance->type = $request->input('type');
        $memberAttendance->date = $request->input('date');
        $memberAttendance->save();

        return $request;
    }

    public function allEventsDates() {
        return eventsAndAnnouncements::all();
    }

    public function attendanceForTheSelectedEvent($id) {
        return eventsAndAnnouncements::where('id', $id)->get();
    }
}

// $table->string('leader');
// $table->string('member');
// $table->string('type');
// $table->string('date');