<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\trainings;
use App\Models\classes;
use App\Models\records;
use App\Models\students;

class trainingsAndClasses extends Controller
{
    // This function is to return all the trainings and classes
    public function returnAllTrainingsAndClasses() {
        $trainingsAndClasses = array('trainings'  => trainings::all(), 'classes' => classes::all());
        return $trainingsAndClasses;
    }

    // This function is to return the trainings made by a certain leader 
    public function returnTrainingsLeader($id) {
        $arrayClassAndTrainings = array();
        $trainingsByInstructor = trainings::all();
        $classByInstructor = classes::all();
        $trainAndClass = array('trainings' => $trainingsByInstructor, 'classes' => $classByInstructor);

        return $trainAndClass;
    }

    // This function will return the class and trainings posted by the current user
    public function trainingsAndClassesPosted($id) {
        $arrayClassAndTrainings = array();
        $trainingsPosted = trainings::where('instructor', $id)->get();
        $classesPosted = classes::where('instructor', $id)->get();

        return array('trainings' => $trainingsPosted, 'classes' => $classesPosted);
    }

    // This function will add a class if the user want to add a class but trainings if want to add trainings
    public function addATrainingOrClass(Request $request) {
        $class = new classes;
        $trainings = new trainings;
        if($request->input('typeOfAdd') === 'Trainings') {
            $trainings->instructor = $request->newTrainings["Instructor"];
            $trainings->name = $request->newTrainings["Name"];
            $trainings->lesson = $request->newTrainings["Lesson"];
            $trainings->title = $request->newTrainings["Title"];
            $trainings->description = $request->newTrainings["Description"];
            $trainings->total = 10;
            $trainings->save();
            return $trainings;
        }else {
            $class->instructor = $request->newClasses["Instructor"];
            $class->name = $request->newClasses["Name"];
            $class->lesson = $request->newClasses["Lesson"];
            $class->title = $request->newClasses["Title"];
            $class->description = $request->newClasses["Description"];
            $class->total = 10;
            $class->save();
            return $class;
        }
    }

    // This function will get the selected item in classes or in trainings
    public function getSelectedClassOrTrainings(Request $request) {
        if($request->input('typeSelected') == 'Trainings') {
            $trainings = trainings::where('id', $request->input('idSelectedItem'))->get(); 
            return $trainings[0];
        }else {
            $classes = classes::where('id', $request->input('idSelectedItem'))->get();
            return $classes[0];
        }
    }

    public function getStudentsOfACertainClassOrTrainings(Request $request) {
        if($request->input('typeSelected') == 'Trainings') {
            $studentForTrainings = records::select('*')
            ->where('trainings_id', $request->input('training'))
            ->get();
            return $studentForTrainings;
        }else {
            $studentForClass = records::select('*')
            ->where('classes_id', $request->input('training'))
            ->get();
            return $studentForClass;
        }
    }
//To update the selected Training or Class
    public function updateSelectedClassOrTrainings(Request $request, $id) {
        if($request->input('typeSelected') == 'Trainings') {
            $updateTraining = trainings::find($id);
            $updateTraining->instructor = $request->input("Instructor");
            $updateTraining->name = $request->input("Name");
            $updateTraining->lesson = $request->input("Lesson");
            $updateTraining->title = $request->input("Title");
            $updateTraining->description = $request->input("Description");
            $updateTraining->total = $request->input("Total");
            $updateTraining->save();

            return $updateTraining;
        }else {
            $updateClass = classes::find($id);
            $updateClass->instructor = $request->input("Instructor");
            $updateClass->name = $request->input("Name");
            $updateClass->lesson = $request->input("Lesson");
            $updateClass->title = $request->input("Title");
            $updateClass->description = $request->input("Description");
            $updateClass->total = $request->input("Total");
            $updateClass->save();

            return $updateClass;
        }
    }
//To delete the selected Training or Class
    public function deleteSelectedClassOrTraining(Request $request, $id) {
        if($request->input('typeSelected') == 'Trainings') {
            $searchStudents = records::where('trainings_id', $id)->get();
            foreach ($searchStudents as $key => $value) {
                if($value->classes_id == null) {
                    records::where('id', $value->id)->delete();
                    students::where('id', $value->students_id)->delete();
                    trainings::where('id', $id)->delete();
                }else {
                    $findTheStudent = records::where('trainings_id', $id)->get();
                    $findTheStudent[0]->trainings_id = null;
                    $findTheStudent[0]->save();
                }
            }
            return $searchStudents;
        }else{
            $searchStudents = records::where('classes_id', $id)->get();
            foreach ($searchStudents as $key => $value) {
                if($value->trainings_id == null) {
                    records::where('id', $value->id)->delete();
                    students::where('id', $value->students_id)->delete();
                    classes::where('id', $id)->delete();
                }else {
                    $findTheStudent = records::where('classes_id', $id)->get();
                    $findTheStudent[0]->classes_id = null;
                    $findTheStudent[0]->save();
                }
            }
            return $searchStudents;
        }
    }
}


    