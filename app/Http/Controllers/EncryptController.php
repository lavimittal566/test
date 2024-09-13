<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class EncryptController extends Controller
{
    public function encrypt(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required',
            'api_key' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $encrypted = Crypt::encryptString($request->input('data'));
        return response()->json(['encrypted_data' => $encrypted]);
    }

    public function decrypt(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'encrypted_data' => 'required',
            'api_key' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $decrypted = Crypt::decryptString($request->input('encrypted_data'));
            return response()->json(['decrypted_data' => $decrypted]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid encrypted data.'], 400);
        }
    }
}
