<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\cms_accounts;
class resetpassword extends Controller
{
    //

    public function resetPassword(Request $request, $id) {
        $resetpassword = cms_accounts::find($id)->first();
        // return $resetpassword;
        $resetpassword->username = $request->input("username");
        $resetpassword->password = $request->input("password");
        $resetpassword->save();

        return $resetpassword;
    }
}
