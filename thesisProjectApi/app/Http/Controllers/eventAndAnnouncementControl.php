<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\eventsAndAnnouncements;
use App\Models\cms_accounts;

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
        $updateEvents->title = $request->input('Title');
        $updateEvents->description = $request->input('Description');
        $updateEvents->start_date = $request->input('Start_date');
        $updateEvents->end_date = $request->input('End_date');
        $updateEvents->start_time = $request->input('Start_time');
        $updateEvents->end_time = $request->input('End_time');
        $updateEvents->location = $request->input('Location');
        $updateEvents->save();

        return $updateEvents;
    }

    public function deleteEventsAndAnnouncement($id) {

        eventsAndAnnouncements::where('id', $id)->delete();
    }
}
