<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\records;
use App\Models\students;
use App\Models\cms_users;

class TrainingsRecords extends Controller
{
    public function addStudentToRecords(Request $request) {
        $studentsRecordOfTrainings = records::select('*')
        ->where('students_id', $request->input('students'))
        ->where('trainings_id', $request->input('trainings'))
        ->get();

        $newStudent = new students;
        $newRecord = new records;
        $newStudent->user_id = $request->input('students');
        $newStudent->level = $request->input('level');
        $newStudent->isAttended = $request->input('isAttended');
        if (count($studentsRecordOfTrainings) == 0) {   
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
            $recordExist = records::where('students_id', $studentsRecordOfTrainings[0]->id)->get();
            
            if($request->input('classes') == null) {
                $recordExist[0]->trainings_id = $request->input('trainings');
            }if($request->input('trainings') == null) {
                $recordExist[0]->classes_id = $request->input('classes');
            }

            $recordExist[0]->classes_id = $request->input('classes');
            $recordExist[0]->type = $request->input('type');
            $recordExist[0]->score = $request->input('score');
            $recordExist[0]->over_all = $request->input('over_all');
            $recordExist[0]->remarks = $request->input('remarks');
            $recordExist[0]->save();
            return $recordExist;
        }
    }

    public function getStudentFromCMS_UserTable($id) {
        $studentsData = students::where('id', $id)->get();
        $studentInCMS_Users = cms_users::where('id', $studentsData[0]->user_id)->get();
        return $studentInCMS_Users;
    }

    // This is a function to delete multiple student
    public function multipleStudentDelete(Request $request) {
        foreach ($request->input('studentsId') as $key => $value) {
            $studentsData = students::where('user_id', $value)->get();
            records::where('students_id', $studentsData[0]->id)->delete();
            students::where('user_id', $value)->delete();
        }
        return 'true';
    }
}