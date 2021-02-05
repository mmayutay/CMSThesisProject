<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoggedUserMatters extends Controller
{
    public function getTheCurrentUser(Request $request) {
        return $request;
    }
}
