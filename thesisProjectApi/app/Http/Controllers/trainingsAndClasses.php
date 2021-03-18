<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\trainings;
use App\Models\classes;
use App\Models\records;

class trainingsAndClasses extends Controller
{

    // This function is to return the trainings made by a certain leader 
    public function returnTrainingsLeader($id) {
        $arrayClassAndTrainings = array();
        $trainingsByInstructor = trainings::where('instructor', $id)->get();
        $classByInstructor = classes::where('instructor', $id)->get();
        $trainAndClass = array('trainings' => $trainingsByInstructor, 'classes' => $classByInstructor);

        return $trainAndClass;
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
        if($request->input('typeSelected') == 'Training') {
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
}
