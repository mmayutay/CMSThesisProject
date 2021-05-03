<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use App\Models\cms_acconts;
use App\Models\recover_passwords;
use App\Http\Requests\UpdatePasswordRequest;

class ChangePasswordController extends Controller
{
    //
    protected $value;
    
    public function confirmCode($codeInput) {
        
        $val = $codeInput;

        $this->value = "i:".$val.";";

        // error_log($this->value);
       
        try{
           $reCode =  recover_passwords::where('code', $this->value)->first();

           if(!is_null($reCode)) {
            //    continue;
            return  response()->json(['message', 'Continue to change password.']);
           }
        }catch(Exception $e) {
            return response()->json(['error', $e->getMessage()]);
        }
    }

    public function passwordResetProcess(UpdatePasswordRequest $request) {

        error_log("Reset Process");

        return $this->updatePasswordRow($request)->count() > 0 ? $this->resetPassword($request) : $this->codeNotFoundError();
    }


    //Verify if code is valid
    private function updatePasswordRow(Request $request) {
        // error_log($this->confirmCode($codeInput));
        error_log($request->passUsername);
        return DB::table('recover_passwords')->where([
            'username' => $request->passUsername,
            'code' => $this->value
        ]);
        error_log($this->value);
    }

    //Token not found response
    private function codeNotFoundError() {
        return response()->json([
            'error' => 'Username or code is wrong'
        ]);
    }

    //Reset password response
    private function resetPassword(Request $request) {
 
        $request = validate([
            'passUsername' => 'required|exists:cms_accounts',
            'newPassword' => 'required|string|min:6|confirmed',
            'confirmPassword' => 'required',
        ]);

        $userData = recover_passwords::where(['username'=> $request->username, 'code' => $this->value])->first();

        if(!$userData)
            return back()->withInput()->with('error', 'INVALID CODE');
        
          $user = cms_accounts::where('username', $request->username)
                                ->update(['password' => bcrypt($request->password)]);
        // $userData->update([
        //     'password' => bcrypt($request->password),
        // ]);

        return response()->json([
            'data' => 'Password has been updated'
        ], Response::HTTP_CREATED);
    }

   
}
