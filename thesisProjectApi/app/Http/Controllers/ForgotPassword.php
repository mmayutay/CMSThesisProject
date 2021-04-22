<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Symfony\Component\HttpFoundation\Response;
USE Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;

use App\SendCode;
use App\Models\cms_accounts;
use App\Models\cms_users;
use App\Models\recover_passwords;

class ForgotPassword extends Controller
{
    //
    

    public function sendForgotPasswordCode(Request $request) {
        $request = 'BHCFMNiere4';
        $value = $request;
        // try
        // {
        //     $username = cms_accounts::where('username', $value)->get();
        //     $username->userid;

        //     $verCode = cms_users::find($username);
            
        //     $verCode->code = \App\SendCode::sendCode($verCode->contact_number);
        //     $verCode->save();

        // } catch (Illuminate\Database\QueryException $e) {
        //     dd($e);
        // }

        if(!$this->validUsername($value)) {
            error_log($value);
            return response()->json([
                'message' => 'Username does not exist.'
            ], Response::HTTP_NOT_FOUND);
        } else {
            $this->verifyCode($value);
            return response()->json([
                'message' => 'Verification Code has been sent to your number.'
            ], Response::HTTP_OK);
        }

    }

    public function validUsername($username) {
       return !!cms_accounts::where('username', $username)->get();
   }

   public function verifyCode($username) {
       $userId = cms_accounts::where('username', $username)->first();
    //    error_log($userId->userid);
       $userId->userid;

       $contact = cms_users::where('id', $userId->userid)->first();
       $number = $contact->contact_number;

       $newCode = new SendCode;
       $code = serialize($newCode->sendCode($number));
       $isOtherCode = recover_passwords::where('username', $username)->first();

       if($isOtherCode) {

           $this->updateCode($code, $username);
       }else {
           $this->storeCode($code, $username);
       }

       return $code;
   }

   public function storeCode($code, $username) {
       DB::table('recover_passwords')->insert([
           'username' => $username,
           'code' => $code,
           'created_at' => Carbon::now(),
       ]);
   }

   public function updateCode($code, $username) {
       $updateCode = recover_passwords::where('username', $username)->first();
       error_log("Update Code");
       error_log($updateCode);
       $updateCode->code = $code;
       $updateCode->save();
   }
}
