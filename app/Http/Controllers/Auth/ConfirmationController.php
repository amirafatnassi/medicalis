<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class ConfirmationController extends Controller
{
    public function verifyEmail(Request $request, $token)
    {
        $patient = Patient::where('verification_token', $token)->first();

        if ($patient) {
            $patient->is_verified = true;
            $patient->verification_token = null;
            $patient->save();

            return view('email-verified');
        } else {
            return view('email-verification-failed');
        }
    }
}
