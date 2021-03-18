<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\trainings;

class trainingsAndClasses extends Controller
{
    // This function is to return the trainings made by a certain leader 
    public function returnTrainingsLeader($id) {
        $trainingsByInstructor = trainings::where('instructor', $id)->get();
        return $trainingsByInstructor;
    }

    public function addATraining(Request $request) {
        
    }
}
