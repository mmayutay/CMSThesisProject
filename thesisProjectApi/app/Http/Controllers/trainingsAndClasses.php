<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\trainings;
use App\Models\lessons;


class trainingsAndClasses extends Controller
{
    // Kini siya nga function kay ang pag add ug trainings with it's lessons 
    public function addTrainingsAndLessons(Request $request) {
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
    public function returnTrainingByUser($id) {
        return trainings::where('instructor', $id)->get();
    }

    // Kini siya nga function kay ang pag add ug lessons sa certain trainings 
    public function addLessonOfTraining(Request $request) {
        $lessons = new lessons;
        $lessons->training_id  = $request->input('trainingsID');
        $lessons->name  = $request->input('name');
        $lessons->lesson  = $request->input('lesson');
        $lessons->title  = $request->input('title');
        $lessons->description  = $request->input('description');
        $lessons->save();
        return $lessons;
    }

    // Kini siya nga function kay i return ang tanan nga lessons sa selected training 
    public function returnLessonsOfTraining($id) {
        return lessons::where('training_id', $id)->get();
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
}

// $table->string('training_id');
// $table->string('name');
// $table->string('lesson');
// $table->string('title');
// $table->string('description');