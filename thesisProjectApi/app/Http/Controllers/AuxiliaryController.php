<?php

namespace App\Http\Controllers;

use App\Models\cms_users;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class AuxiliaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $value = $request->input('auxi');
        //Filtering the users who are 13 yrs old and below
        if($value === "Kids") 
        {
            $holder = cms_users::where('age','<', 14)->get();
            error_log($holder);
            return $holder;
        }
        //Filtering the users who are 14 and above but lesser than 22
        if($value === "Youth" )
        {
            $holder = cms_users::select('*')
                            ->where('age', '>', 13)
                            ->where('age','<', 22)
                            ->get();
            // dd($holder);
            // error_log($holder->age);
            return $holder;
        }
        //Filtering the users that are single in marital_status
        if($value === "Single")
        {
            $holder = cms_users::select('*')
                            ->where('marital_status', 'Single')
                            ->where('age', '>', 21)
                            ->get();
            return $holder;
        }
        //Filtering the users that are married men
        if($value === "Mmen")
        {
            $holder = cms_users::select('*')
                            ->where('marital_status', 'Married')
                            ->where('gender', 'Male')
                            ->get();

            return $holder;
        }
        //Filtering the users that are married women
        if($value === "Mwomen")
        {
            $holder = cms_users::select('*')
                            ->where('marital_status', "Married")
                            ->where('gender', 'Female')
                            ->get();

            return $holder;
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
