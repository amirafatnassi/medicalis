<?php

namespace App\Listeners;

use App\Events\PatientVerified;
use Illuminate\Contracts\Queue\ShouldQueue;

class PatientVerifiedListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\PatientVerified  $event
     * @return void
     */
    public function handle(PatientVerified $event)
    {
        // Perform any actions you want after a patient's email is verified
        // For example, you can send a notification or update patient information
        // Access the patient using $event->patient
        $patient = $event->patient;
        
        // Example action:
        // Update the "email_verified_at" field in the patient table
        $patient->email_verified_at = now();
        $patient->save();
    }
}
