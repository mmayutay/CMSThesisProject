<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\eventsAndAnnouncements;
use App\Models\cms_accounts;
use App\Models\records;
use App\Models\students;

class eventAndAnnouncementControl extends Controller
{
    public function addEventOrAnnouncement(Request $request) {
        $addedEvent = new eventsAndAnnouncements;
        $addedEvent->title = $request->newEvents['Title'];
        $addedEvent->description = $request->newEvents['Description'];
        $addedEvent->start_date = $request->newEvents['Start_date'];
        $addedEvent->end_date = $request->newEvents['End_date'];
        $addedEvent->start_time = $request->newEvents['Start_time'];
        $addedEvent->end_time = $request->newEvents['End_time'];
        $addedEvent->location = $request->newEvents['Location'];
        $addedEvent->eventOwner = $request->currentUser['userID'];
        $addedEvent->save();
        return $addedEvent;
    }

    public function returnAllEventsAndAnnouncement() {
        $returnEvents = eventsAndAnnouncements::all();

        return $returnEvents;
    }

    public function updateEventsAndAnnouncement(Request $request, $id) {
        
        $updateEvents = eventsAndAnnouncements::find($id);
        $updateEvents->title = $request->input('title');
        $updateEvents->description = $request->input('description');
        $updateEvents->start_date = $request->input('start_date');
        $updateEvents->end_date = $request->input('end_date');
        $updateEvents->start_time = $request->input('start_time');
        $updateEvents->end_time = $request->input('end_time');
        $updateEvents->location = $request->input('location');
        $updateEvents->save();

        return $updateEvents;
    }

    public function deleteEventsAndAnnouncement($id) {

        eventsAndAnnouncements::where('id', $id)->delete();
        return response()->json(['success' => "Deleted successfully!"]);
    }

    public function eventOwner($eventOwnerId) {
        $eventOwnerDisplay = eventsAndAnnouncements::where('eventOwner', $eventOwnerId)->get();

        return $eventOwnerDisplay;
    }

    public function returnEvent($id) {

        $returnEventsById = eventsAndAnnouncements::find($id);

        return $returnEventsById;
    }

    public function deleteMultipleEventsAndAnnouncement(Request $request) {
        $ids = $request->ids;
        deleteEventsAndAnnouncement::whereInt('id', explode(",", $ids))->delete();
        return response()->json(['success' => "Deleted successfully!"]);
    }

    public function returnAllStudents($id) {
        $arrayOfStudents = array();
        $students = records::where('trainings_id', $id)->get()->pluck('students_id');
        foreach ($students as $key => $value) {
            $studentsID = students::where('id', $value)->get()->pluck('user_id');
            array_push($arrayOfStudents, $studentsID[0]);
        }
        return $arrayOfStudents;
    }
}
