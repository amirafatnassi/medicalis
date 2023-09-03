<?php

namespace App\Http\Controllers;

use App\Listeners\PatientVerifiedListener;
use App\Models\Dossier;
use App\Models\DossierUser;
use App\Models\DossierAccessHistory;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    use VerifiesEmails, RedirectsUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath()); // Redirect to the desired URL after successful verification
        }

        return view('verification.notice', [
            'pageTitle' => __('Account Verification')
        ]);
    }

    public function verify(EmailVerificationRequest $request)
    {
        $user = $request->user();

        // Check if the user's email is already verified
        if ($user->hasVerifiedEmail()) {
            return redirect('/email-verified'); // Redirect to the email-verified.blade.php view
        }

        // Check if the verification URL is valid and the token is not expired
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            return redirect('/email-verified'); // Redirect to the email-verified.blade.php view
        }

        return redirect('/email-verification-failed'); // Redirect to the email-failed-verification.blade.php view
    }

    public function accessGrantEmail($dossier_id)
    {
        $dossier = Dossier::with('user')->findorFail($dossier_id);
        DossierUser::Create([
            'dossier_id' => $dossier_id,
            'user_id' => Auth::user()->id
        ]);
        DossierAccessHistory::create([
            'dossier_id' => $dossier_id,
            'user_id' => Auth::user()->id,
            'granted' => 1,
            'created_by' => Auth::user()->id

        ]);
        return view('emails.access_grant', compact('dossier'));
    }
}
