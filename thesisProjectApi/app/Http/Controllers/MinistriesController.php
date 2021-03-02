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
            // error_log($holder);
            return $holder;

        }
        //
        if($value === "Multimedia")
        {
            $holder = cms_users::where('ministries', $value)->get();
            // error_log($holder);
            return $holder;
        }
        //
        if($value === "Hospitality")
        {
            $holder = cms_users::where('hospitality', $value)->get();
            // error_log($holder);
            return $holder;
        }
    }

    public function getMinistry(Request $request)
    {
        //
        $value = $request->input('ministries');
        error_log("Ministry: ",$value);
        return $value;
    }

   
    public function ministryList()
    {
        $list = cms_users::all();

        // error_log($list);
        return $list;
    }
    public function store(Request $request, $id)
    {
        //        
        $value = $request->input('ministries');

        $user = cms_users::find($id);
        
        // $user->find($id);
        
        $user->ministries = $value;

        $user->save();

        return $user;

    }

    // public function searchUser(Request $request) {
    //     $search = $request->get('search');
    //     error_log($search);
    //     if( $search != "") 
    //     {
    //         $user = cms_users::where('firstname', 'LIKE', '%' . $search . '%')
    //                         ->orWhere('lastname', 'LIKE', '%' . $search . ' %')
    //                         ->get()
    //                         ->paginate(10);
                        
    //         if(count($user) > 0)
    //         {
    //             return $user;
    //         }
    //     }
    //     return "No users found.";
        
    // }

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
