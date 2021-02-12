<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cms_users;
use App\Http\Controllers\UserDisplayController;

class UserDisplayController extends Controller
{
    
    public function index()
    {
        
        $users = cms_users::all();
        
        return view('welcome')->with(compact('users',$users));
    }

    public function getUsers(Request $request){
        $userRequest = cms_users::where('id', $request->input('userID'))
        ->get();
        return $userRequest;
    }

    public function create()
    {
        //
    }

    // public function getUsers(Request $request){
    //     $userRequest = cms_users::where('id', $request->input('userID'))
    //     ->get();
    //     return $userRequest;
    // }

  
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'lastname' => 'required',
            'firstname' => 'required',
            'birthday' => 'required',
            'age' => 'required',
            'gender' => '',
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

    public function show($id)
    {
        //
        $info = cms_users::find($id);

        return $info;
    }
    
    // public function edit($id)
    // {
    //     //
    //     $info = cms_users::find($id);
    //     return view('edit')->with(compact('info', $info));
    // }
 
    public function update(Request $request)
    {
        $id = $request->newUser['id'];

        $info = cms_users::find($id);
        $info->lastname = $request->input('Lastname');
        $info->firstname = $request->input('Firstname');
        $info->birthday = $request->input('Birthday');
        $info->age = $request->input('Age');
        $info->gender = $request->input('Gender');
        $info->address = $request->input('Address');
        $info->marital_status = $request->input('Marital_status');
        $info->email = $request->input('Email');
        $info->contact_number = $request->input('Contact_number');
        $info->facebook = $request->input('Facebook');
        $info->instagram = $request->input('Instagram');
        $info->twitter = $request->input('Twitter');
        $info->save();

        return $info;
    }

    public function insert(Request $request)
    {
        $id = $request->newUser['id'];

        $cell = cms_members::find($id);
        $cell->name =  $request->input('Name');
        $cell->email = $request->input('Email');
        $cell->leader = $request->input('Leader');
        $cell->age = $request->input('Age');
        $cell->member_status = $request->input('Member_status');
        $cell->save();

        return $cell;
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
