<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\records;

class RecordsController extends Controller
{
    public function addNewRecord(Request $request) {
        $record = new records; 
        $record->lessons_id = $request->input('lessons_id');
        $record->classes_id = $request->input('classes_id');
        $record->students_id = $request->input('students_id');
        $record->type = $request->input('type');
        $record->score = $request->input('score');
        $record->overall = $request->input('over_all');
        $record->remarks = $request->input('remarks');
        $record->save();
        return $record;
    }

    // Kini siya nga function kay kuhaon niya ang tanan nga students gikan sa selected lesson and classes 
    public function getAllStudentsFromRecords($lessonID, $classID) {
        return records::select('*')
                        ->where('lessons_id', $lessonID)
                        ->where('classes_id', $classID)
                        ->get();
    }
}


// $table->string('lessons_id');
// $table->string('classes_id');
// $table->string('students_id');
// $table->string('type');
// $table->string('score');
// $table->string('overall');
// $table->string('remarks');