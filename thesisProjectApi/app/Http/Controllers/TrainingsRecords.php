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

    public function getStudentFromCMS_UserTable(Request $request, $id) {
        $studentsData = students::where('id', $id)->get();
        $studentInCMS_Users = cms_users::where('id', $studentsData[0]->user_id)->get();
        return $studentInCMS_Users;
    }

    // This function is to get the student using the ID of the user
    public function getStudentFromStudentTable($id) {
        return students::where('user_id', $id)->get();
    }

    //To update selected record
    public function updateRecord($id) {
        $updateRecord = records::find($id);
        $updateRecord->type = $request->input('type');
        $updateRecord->score = $request->input('score');
        $updateRecord->over_all = $request->input('over_all');
        $updateRecord->remarks = $request->input('remarks');
        $updateRecord->save();

        return $updateRecord;
    }

    //To delete selected record
    public function students(){
        return $this->hasMany('App\Models\students');
    }
    
    public function deleteRecord($id) {
        $deleteRecord = records::find($id);
        $deleteRecord->students()->delete();
        $deleteRecord->delete();
    }

    //To delete selected student
    public function deleteStudent($id) {
        $deletedData = array('record' => records::where('students_id', $id)->delete(), 'member' => students::find($id)->delete());
        return $deletedData;
    }

    public function multipleStudentDelete(Request $request) {
        foreach ($request->input('studentsId') as $key => $value) {
            records::select('*')
                    ->where('trainings_id', $request->selectedTraining)
                    ->where('students_id', students::where('user_id', $value)->get()[0]->id)->delete();
        }
        // return $request;
    }


}

