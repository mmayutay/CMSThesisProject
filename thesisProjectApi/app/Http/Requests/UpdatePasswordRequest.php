<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest {

    public function authorize() {

        return true;
    }

    public function rules() {
        error_log("Password Request");
        return [
            'passUsername' => 'required|string',
            'newPassword' => 'required|string',
            'confirmPassword' => 'required|string'
        ];
    }
}