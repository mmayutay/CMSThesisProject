<?php

namespace App\Http\Controllers;

use App\Models\classes;
use App\Models\lessons;
use App\Models\records;
use App\Models\students;
use App\Models\trainings;
use App\Models\cms_users;
use Illuminate\Http\Request;

class trainingsAndClasses extends Controller
{
    // Kini siya nga function kay i return ang tanan nga trainings 
    public function returnAllTrainings() {
        return trainings::all();
    }
    // Kini siya nga function kay ang pag add ug trainings with it's lessons
    public function addTrainingsAndLessons(Request $request)
    {
        $trainings = new trainings;
        $trainings->code = $request->input('code');
        $trainings->instructor = $request->input('instructor');
        $trainings->title = $request->input('title');
        $trainings->description = $request->input('description');
        $trainings->level = $request->input('level');
        $trainings->save();
        return $trainings;
    }

    // Kini siya nga function kay kuhaon niya ang tanan nga trainings nga gihimo sa certain user
    public function returnTrainingByUser($id)
    {
        return trainings::where('instructor', $id)->get();
    }

    // Kini siya nga function kay ang pag add ug lessons sa certain trainings
    public function addLessonOfTraining(Request $request, $trainingsID)
    {
        $lessons = new lessons;
        $lessons->training_id = $trainingsID;
        $lessons->name = $request->input('name');
        $lessons->lesson = $request->input('lesson');
        $lessons->title = $request->input('title');
        $lessons->description = $request->input('description');
        $lessons->save();
        return $lessons;
    }

    // Kini siya nga function kay i return ang tanan nga lessons sa selected training
    public function returnLessonsOfTraining($id)
    {
        return lessons::where('training_id', $id)->get();
    }

    // Kini siya nga function kay i return ang details sa selected lesson using an ID 
    public function returnLessonDetails($lessonID) {
        return lessons::where('id', $lessonID)->get();
    }

    // Kini siya nga function kay i return ang selected class 
    public function returnSelectedClass($id) 
    {
        return classes::where('id', $id)->get();
    }

    // Kini siya nga function kay i return ang selected Training 
    public function returnSelectedTraining($id) 
    {   
        return trainings::where('id', $id)->get();
    }

    // Kini siya nga function kay i return ang tanan nga classes sa selected lesson sa usa ka training
    public function returnClasses($id)
    {
        return classes::where('training_id', $id)->get();
    }

    // Kini siya nga function kay kuhaon ang mga id sa mga students nga connected ra sad sa users nga collection
    public function returnStudentsID($classID) {
        $arrayOfStudentsID = array();
        $studentsID = records::where('classes_id', $classID)->get()->pluck('students_id');
        foreach ($studentsID as $key => $value) {
            $student = students::where('id', $value)->get()[0]->user_id;
            array_push($arrayOfStudentsID, $student);
        }
        return $arrayOfStudentsID;
    }  

    // Kini siya nga function kay mag add ug students class
    public function addClasses(Request $request)
    {
        $classes = new classes;
        $classes->training_id = $request->className['selectedTrainingID'];
        $classes->name = $request->className['Name'];
        $classes->remarks = $request->className['Description'];
        $classes->save();
        return $classes;
    }

    // Kini siya nga function kay mag ug student sa class
    public function addStudentToAClass(Request $request)
    {
        $student = new students;
        $student->user_id = $request->input('userID');
        $student->level = '';
        $student->remarks = '';
        $student->save();
        return $student;
    }

    // Kini siya nga function kay kuhaon ang tanan nga students_id sa selected class 
    public function getStudentOfSelectedClass($classID) {
        return records::where('classes_id', $classID)->get();
    } 

    // Kini siya nga function kay ang pag add ug records sa student
    public function addStudentRecord(Request $request) {
        $records = new records;
        $records->lessons_id = $request->input('selectedTrainingID');
        $records->classes_id = $request->input('classesID');
        $records->students_id = $request->input('studentID');
        $records->type = '';
        $records->score = 0;
        $records->overall = 0;
        $records->remarks = '';
        $records->save();
        return $records;
    }

    // Kini siya nga function kay iyang i update ang score sa student sa certain records 
    public function updateStudentsScore($studentId, $score) {
        $records = records::where('students_id', $studentId)->get()[0];
        $records->score = $score;
        $records->save();
        return $records;
    }
    //Kini siya nga function kay mu update sa selected lesson
    public function updateLessonOfTraining(Request $request, $id) {
            $lesson = lessons::find($id);
            $lesson->name = $request->input('Name');
            $lesson->lesson = $request->input('Lesson');
            $lesson->title = $request->input('Title');
            $lesson->description = $request->input('Description');
            $lesson->save();
        return response()->json(['success' => 'Updated successfully!']);
    }

    //Kini siya nga function kay mudelete sa selected nga lesson
    public function deleteLessonsOfTraining($id) {

        lessons::where('id', $id)->delete();
        return response()->json(['success' => 'Deleted successfully!']);
    }

    // Kini siya nga function kay i return ang id sa student sa student nga collection 
    public function returnStudentFromStudentCollection($usersID) {
        return students::where("user_id", $usersID)->get()[0];
    }
}

