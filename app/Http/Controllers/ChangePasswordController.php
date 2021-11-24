<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symphony\Component\HttpFoundation\Response;

use App\Models\cms_acconts;
use App\Http\Requests\UpdatePasswordRequest;

class ChangePasswordController extends Controller
{
    //
    public function passwordResetProcess(UpdatePasswordRequest $request) {
        return $this->updatePasswordRow($request)->count() > 0 ? $this->resetPassword($request) : $this->codeNotFoundError();
    }


    //Verify if code is valid
    private function updatePasswordRow(Request $request) {
        return DB::table('recover_password')->where([
            'username' => $request->email,
            'code' => $request->passCode
        ]);
        // $data = $request->validate([
        //     'username' => 'requiresd|string',
        //     'code'=> 'required|string',
        // ]);

        // $holder = DB::table('recover_password')->where([
        //         'username' => $request->email,
        //         'code' => $request->passCode
        //     ]);

        // $count = count($holder);

        // if() {

        // }
    }

    //Token not found response
    private function codeNotFoundError() {
        return response()->json([
            'error' => 'Username or code is wrong'
        ],Response::HTTP_UNPROCESSABLE_ENTIY);
    }

    //Reset password response
    private function resetPassword($request) {

        $userData = cms_accounts::where('username', $request->username)->first();

        $userData->update([
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'data' => 'Password has been updated'
        ], Response::HTTP_CREATED);
    }
}
