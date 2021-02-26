<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cms_users;
use App\Models\cms_ministries;

class MinistriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $value = $request->input('ministries');
        //
        if($value === "PraiseAndWorship")
        {
            $holder = cms_users::where('ministries', $value)->get();
            error_log($holder);
            return $holder;

        }
        //
        if($value === "Multimedia")
        {
            $holder = cms_users::where('ministries', $value)->get();
            error_log($holder);
            return $holder;
        }
        //
        if($value === "Hospitality")
        {
            $holder = cms_users::where('ministries', $value)->get();
            error_log($holder);
            return $holder;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMinistry()
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
        $ministries = new cms_ministries;

        $ministries->ministry = $request->ministry;
        $ministries->firsname = $request->firstname;
        $ministries->lastname = $request->lastname;
        $ministries->save();
        return $ministries;

    }

    public function searchUser(Request $request) {
        $search = Input::get('search');
        if( $search != "") 
        {
            $user = cms_users::where('firstname', 'LIKE', '%' . $search . '%')
                            ->orWhere('lastname', 'LIKE', '%' . $search . ' %')
                            ->get()
                            ->paginate(10);
                        
            if(count($user) > 0)
            {
                return view('welcome')->withDetails($user)->withQuery($search);
            }
        }
        return view('welcome')->withMessage("No users found.");
        
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
