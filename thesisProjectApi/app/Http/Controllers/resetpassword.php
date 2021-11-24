<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\cms_accounts;
use App\Rules\IsValidPassword;
use Validator;
use Illuminate\Validation\Rule;

class resetpassword extends Controller
{
    //

    public function resetPassword(Request $request)
    {
        try {
            $rules = array(
                'username' => 'required',
                'currpassword' => 'required',
                'newPassword' => [
                    'required', 'string', 'min:8'
                ]
            );

            $request->validate(
                $rules
            );

            $value = $request->currpassword;

            $user = cms_accounts::where('username', $request->username)->first();

            if (!is_null($user)) {
                error_log($user->password);
                if (Hash::check($value, $user->password)) {
                    $user->password = Hash::make($request->newPassword);
                    $user->save();

                    return $user;
                }
            }
        } catch (\Illuminate\Validation\ValidationException $e) {

            return null;
        }
    }
}
