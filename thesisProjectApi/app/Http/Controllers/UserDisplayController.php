<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cms_users;
use App\Models\cms_accounts;
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
 
    public function update(Request $request, $id)
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

        // return $info;
    }

    public function getAllLeaders() {
        $arrayOfLeaders = array();
        $getAllLeaders = cms_accounts::where('roles', 3)->get()->pluck('userid');
        foreach ($getAllLeaders as $key => $value) {
            array_push($arrayOfLeaders, cms_users::where('id', $value)->get()[0]);
        }
        return $arrayOfLeaders;

    }

    public function getUserAccount($id) {
        return cms_accounts::where('userid', $id)->get()[0];
    }

    // public function insert(Request $request)
    // {
    //     $id = $request->newUser['id'];

    //     $cell = cms_members::find($id);
    //     $cell->name =  $request->input('Name');
    //     $cell->email = $request->input('Email');
    //     $cell->leader = $request->input('Leader');
    //     $cell->age = $request->input('Age');
    //     $cell->member_status = $request->input('Member_status');
    //     $cell->save();

    //     return $cell;
    // }

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
