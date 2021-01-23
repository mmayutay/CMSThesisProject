<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataRequests;
use App\Models\cms_members;
use App\Models\cms_users;

class Controls extends Controller
{
    public function list() {
        return 'Data Sample!';
    }

    public function getUserInfo(Request $request) {
        $email = $request->input('Email');
        $userInfo = cms_members::where('Email', $email)
        ->get();
        return $userInfo;
    }
    public function getAllUsers() {
        $allUsers = cms_users::all();
        return $allUsers;
    }
}
