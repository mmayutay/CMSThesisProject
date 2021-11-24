<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cms_users;
use App\Models\cms_accounts;
use App\Models\eventsAndAnnouncements;


class UserDisplayController extends Controller
{

    public function index()
    {

        $users = cms_users::all();

        return view('welcome')->with(compact('users', $users));
    }

    public function getUsers(Request $request)
    {
        $userRequest = cms_users::where('id', $request->input('userID'))
            ->get();
        return $userRequest;
    }

    public function returnAllPastorsWithItsLeaders()
    {
        $arrayOfPastors = array();
        $pastors = cms_accounts::where('roles', 1)->get();
        foreach ($pastors as $key => $value) {
            $user = cms_users::where('id', $value->userid)->get()[0];
            $allPastorsMember = cms_users::where('leader', $user->id)->get();
            array_push($arrayOfPastors, array("pastor" => $user, "leaders" => $allPastorsMember));
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
        $arrayOfLeaders = array();
        $getAllLeaders = cms_accounts::where('roles', $role)->get()->pluck('userid');
        foreach ($getAllLeaders as $key => $value) {
            array_push($arrayOfLeaders, cms_users::where('id', $value)->get()[0]);
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
        $pastorsArray = array();
        $usersIDs = cms_accounts::where("roles", $code)->get()->pluck("userid");
        foreach ($usersIDs as $key => $value) {
            $userData = cms_users::where('id', $value)->get()[0];
            array_push($pastorsArray, $userData);
        }
        return $pastorsArray;
    }

    // Kini siya nga function kay kuhaon niya ang iyang cellgroup, ang kapareho niya ug role 
    public function returnCellGroup($role)
    {
        $arrayOfUsers = array();
        $sameRoles = cms_accounts::where("roles", $role)->get();
        foreach ($sameRoles as $key => $value) {
            $userData = cms_users::where("id", $value->userid)->get()[0];
            array_push($arrayOfUsers, $userData);
        }
        return $arrayOfUsers;
    }


    // Kini siya nga function kay kuhaon ang members sa certain leader and check at the same time kung naa sad siyay member nga naa say member
    public function returnMembersOfCertainLeader($leaderID)
    {
        $leaders = array();
        $members = cms_users::where('leader', $leaderID)->get();
        if (count($leaders) == 0) {
            array_push($leaders, cms_users::where('id', $leaderID)->get()[0]);
        } else {
            array_push($leaders, cms_users::where('id', $leaderID)->get()[0]);
        }
        foreach ($members as $key => $value) {
            $leaderMember = cms_users::where('leader', $value->id)->get();
            if (count($leaderMember) != 0) {
                array_push($leaders, $value);
            }
        }
        return $leaders;
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

    public function deleteUser($id)
    {

        // $accountId = cms_accounts::find($id);

        // $userId = cms_users::where('id', $id)->first();

        $events = eventsAndAnnouncements::where('eventOwner', $id)->first();

        if ($events) {
            eventsAndAnnouncements::where('eventOwner', $id)->delete();
            cms_users::where('id', $id)->delete();
            cms_accounts::where('userid')->delete();
        } else {
            cms_users::where('id', $id)->delete();
            cms_accounts::where('userid')->delete();
        }
        return response()->json(['success', 'Deleted succesfully']);
    }

    // Kini siya nga function kay mag delete ug user account 
    public function deleteUserAccount($id)
    {
        return cms_accounts::where('userid', $id)->delete();
    }

    public function switchVIPToRegular($userID)
    {
        $selectedUser = cms_users::where('id', $userID)->get();
        $selectedUser[0]->isCGVIP = 'false';
        $selectedUser[0]->isSCVIP = 'false';
        $selectedUser[0]->save();
        return $selectedUser[0];
    }
}
