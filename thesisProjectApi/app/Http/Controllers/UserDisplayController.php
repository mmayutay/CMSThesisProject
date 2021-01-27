<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cms_users;
use App\Http\Controllers\UserDisplayController;

class UserDisplayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = cms_users::all();
        
        return view('welcome')->with(compact('users',$users));
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
        $this->validate($request, [
            'lastname' => 'required',
            'firstname' => 'required',
            'birthday' => 'required',
            'age' => 'required',
            'address' => 'required',
            'marital_status' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
            'facebook' => '',
            'instagram' => '',
            'twitter' => '',
            'leader' => 'required',
            'category' => 'required',
            'isCGVIP' => 'true',
            'isSCVIP' => 'true',
            'auxilliary' => 'required',
            'ministries' => 'required',
        ]);
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

        $info = cms_users::find($id);

        return view('edit')->with(compact('info', $info));
        

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
        $info = cms_users::find($id);
        return view('edit')->with(compact('info', $info));
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
