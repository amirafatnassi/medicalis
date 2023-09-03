<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailConfirmation;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    use VerifiesEmails;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request)
    {
        $id = $request->query('id');
        $hash = $request->query('hash');
        $user = User::findorFail($id);

        if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($user->verification_token === $hash) {
            DB::transaction(function () use ($user) {
                $user->markEmailAsVerified();
            });

            return redirect('emails/email-verified')->with('verified', true);
        } else {
            return redirect('emails/email-verification-failed')->with('verified', false);
        }
    }

    public function resend(Request $request)
    {
        if ($request->user() && !$request->user()->hasVerifiedEmail()) {
            // $request->user()->sendEmailVerificationNotification();
            Mail::to($request->user()->email)->send(new EmailConfirmation($request->user()));
             return $request->wantsJson()
                ? new JsonResponse([], 202)
                : redirect('/')->with('resent', true);
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect($this->redirectPath());
    }
}
