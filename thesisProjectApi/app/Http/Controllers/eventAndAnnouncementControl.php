<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\eventsAndAnnouncements;


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
        $addedEvent->save();
        return $addedEvent;
    }
}
