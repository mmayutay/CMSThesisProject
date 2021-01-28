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
            'isCGVIP' => 'required',
            'isSCVIP' => 'required',
            'auxilliary' => 'required',
            'ministries' => 'required',
        ]);

        $info = cms_users::find($id);
        $info->lastname = $request->input('lastname');
        $info->firstname = $request->input('firstname');
        $info->birthday = $request->input('birthday');
        $info->age = $request->input('age');
        $info->address = $request->input('address');
        $info->marital_status = $request->input('marital_status');
        $info->email = $request->input('email');
        $info->contact_number = $request->input('contact_number');
        $info->facebook = $request->input('facebook');
        $info->instagram = $request->input('instagram');
        $nfo->twitter = $request->input('twitter');
        $info->leader = $request->input('leader');
        $info->category = $request-> input('category');
        $info->isCGVIP = $request->input('isCGVIP');
        $info->isSCVIP = $request->input('isSCVIP');
        $info->auxilliary = $request->input('auxilliary');
        $info->ministries = $reques->input('ministries');
        $info->save();

        return redirect('/info')->with('success', 'Post updated');
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
