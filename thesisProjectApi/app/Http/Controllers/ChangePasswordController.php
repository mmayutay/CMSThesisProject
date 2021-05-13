<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Crypt;
use App\Models\cms_accounts;
use App\Models\recover_passwords;
use App\Http\Requests\UpdatePasswordRequest;

class ChangePasswordController extends Controller
{
    //
    public function resetPassword(Request $request)
    {
        try {
            $value = $request->currpassword;

            $user = cms_accounts::where(
                'username',
                $request->username
            )->first();

            if (!is_null($user)) {
                // $val =Crypt::decryptString($user->password);
                $password = \Hash::check($value, $user[0]->password);
                if ($password) {
                    $user->password = Crypt::encryptString(
                        $request->newPassword
                    );
                    $user->save();

                    return $user;
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'error',
                'Username or Password is incorrect ' . $e->getMessage(),
            ]);
        }
    }
}
