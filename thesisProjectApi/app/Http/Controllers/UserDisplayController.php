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

        return view('hello world')->with(compact('users', $users));
    }

    public function getUsers(Request $request)
    {
        $userRequest = cms_users::where('id', $request->input('userID'))->get();
        return $userRequest;
    }

    public function returnAllPastorsWithItsLeaders()
    {
        $arrayOfPastors = [];
        $pastors = cms_accounts::where('roles', 1)->get();
        foreach ($pastors as $key => $value) {
            $user = cms_users::where('id', $value->userid)->get()[0];
            $allPastorsMember = cms_users::where('leader', $user->id)->get();
            array_push($arrayOfPastors, [
                'pastor' => $user,
                'leaders' => $allPastorsMember,
            ]);
        }
        return $arrayOfPastors;
    }

    public function create()
    {
        //
    }

    public function update(Request $request)
    {
        $id = $request->newUser['id'];

        $info = cms_users::find($id);

        // return $info;
        $info->lastname = $request->newUser['Lastname'];
        $info->firstname = $request->newUser['Firstname'];
        $info->birthday = $request->newUser['Birthday'];
        $info->age = $request->newUser['Age'];
        $info->gender = $request->newUser['Gender'];
        $info->address = $request->newUser['Address'];
        $info->marital_status = $request->newUser['Marital_status'];
        $info->email = $request->newUser['Email'];
        $info->contact_number = $request->newUser['Contact_number'];
        $info->facebook = $request->newUser['Facebook'];
        $info->instagram = $request->newUser['Instagram'];
        $info->twitter = $request->newUser['Twitter'];
        $info->save();

        return $info;
    }

    public function getAllLeaders($role)
    {
        $arrayOfLeaders = [];
        $getAllLeaders = cms_accounts::where('roles', $role)
            ->get()
            ->pluck('userid');
        foreach ($getAllLeaders as $key => $value) {
            array_push(
                $arrayOfLeaders,
                cms_users::where('id', $value)->get()[0]
            );
        }
        return $arrayOfLeaders;
    }

    public function getUserAccount($id)
    {
        return cms_accounts::where('userid', $id)->get()[0];
    }

    // Kini siya nga function kay kuhaon ang tanan nga code 1
    public function getAllPastorCode1($code)
    {
        $pastorsArray = [];
        $usersIDs = cms_accounts::where('roles', $code)
            ->get()
            ->pluck('userid');
        foreach ($usersIDs as $key => $value) {
            $userData = cms_users::where('id', $value)->get()[0];
            array_push($pastorsArray, $userData);
        }
        return $pastorsArray;
    }

    // Kini siya nga function kay kuhaon niya ang iyang cellgroup, ang kapareho niya ug role
    public function returnCellGroup($role)
    {
        $arrayOfUsers = [];
        $sameRoles = cms_accounts::where('roles', $role)->get();
        foreach ($sameRoles as $key => $value) {
            $userData = cms_users::where('id', $value->userid)->get()[0];
            array_push($arrayOfUsers, $userData);
        }
        return $arrayOfUsers;
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
