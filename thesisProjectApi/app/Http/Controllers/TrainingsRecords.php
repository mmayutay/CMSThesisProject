<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\records;
use App\Models\students;
use App\Models\cms_users;

class TrainingsRecords extends Controller
{
    public function addStudentToRecords(Request $request) {
        $newStudent = new students;
        $newRecord = new records;
        $searchIfExist = students::where('user_id', $request->input('students'))->get();
        $newStudent->user_id = $request->input('students');
        $newStudent->level = $request->input('level');
        $newStudent->isAttended = $request->input('isAttended');
        if (count($searchIfExist) == 0) {   
            $newStudent->save();

            $newRecord->trainings_id = $request->input('trainings');
            $newRecord->classes_id = $request->input('classes');
            $newRecord->students_id = $newStudent->id;
            $newRecord->type = $request->input('type');
            $newRecord->score = $request->input('score');
            $newRecord->over_all = $request->input('over_all');
            $newRecord->remarks = $request->input('remarks');
            $newRecord->save();
            return $newRecord;
        }else {
            return $searchIfExist[0];
            $recordExist = records::where('');


            $searchIfExist[0]->trainings_id = $request->input('trainings');
            $searchIfExist[0]->classes_id = $request->input('classes');
            $searchIfExist[0]->type = $request->input('type');
            $searchIfExist[0]->score = $request->input('score');
            $searchIfExist[0]->over_all = $request->input('over_all');
            $searchIfExist[0]->remarks = $request->input('remarks');
            $searchIfExist[0]->save();
            return $searchIfExist;
        }
    }

    public function getStudentFromCMS_UserTable($id) {
        $studentsData = students::where('id', $id)->get();
        $studentInCMS_Users = cms_users::where('id', $studentsData[0]->user_id)->get();
        return $studentInCMS_Users;
    }
}

// $table->foreign('user_id')->references('id')->on('cms_users');
// $table->string('level');
// $table->string('isAttended');

// trainings: null,
// classes: null,
// students: '',
// type: '',
// score: 0,
// over_all: 0,
// remarks: 'Add a note!'