<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataRequests;
use App\Models\cms_members;
use App\Models\cms_users;
use App\Models\cms_accounts;


class Controls extends Controller
{
    public function list() {
        return cms_users::all();
    }
    public function allAccount() {
        return cms_accounts::all();
    }

    public function getUserInfo(Request $request) {
        $email = $request->input('Email');
        $userInfo = cms_members::where('Email', $email)
        ->get();
        return $userInfo;
    }
}
