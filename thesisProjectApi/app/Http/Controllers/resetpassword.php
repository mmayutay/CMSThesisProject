<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\cms_accounts;
class resetpassword extends Controller
{
    //

    public function resetPassword(Request $request, $id) {
        $request = validate([
            'passUsername' => 'required|exists:cms_accounts',
            'newPassword' => 'required|string|min:6|confirmed',
            'confirmPassword' => 'required',
        ]);

        $user = cms_accounts::where('passUsername', $request->username)
                            ->update(['newPassword' => bcrypt($request->password)]);

        return response()->json([
            'data' => 'Password has been updated'
        ], Response::HTTP_CREATED);
    }
}
