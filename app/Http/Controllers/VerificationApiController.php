<?php

namespace App\Http\Controllers;

use App\Events\EmailVerified;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;

class VerificationApiController extends Controller

{
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json('User already have verified email!', 422);
        }

        $user = auth()->user();
        $data = array('name' => $user->first_name . ' ' . $user->last_name, 'link' => 'clinicareapp.com/verify/' . $user->id);
        Mail::send('mail', $data, function ($message) use ($user) {
            $message->to($user->email, 'Verify Account')->subject('Verify Your Account');
            $message->from('info@clinicareapp.com', 'Clinicare');
        });

        return response()->json('The notification has been resubmitted');
    }

    public function verify(User $user)
    {

        if ($user->email_verified_at) {
            return response()->json('Email address already verified!', 422);
        }

        if ($user->markEmailAsVerified()) {
            return response()->json(['status' => 'success', 'message' => 'Email verified successfully!']);
        } else {
            return response()->json('Invalid verification code!', 422);
        }
    }

    public function verify_doctor(Doctor $doctor)
    {

        if ($doctor->email_verified_at) {
            return response()->json('Email address already verified!', 422);
        }

        if ($doctor->markEmailAsVerified()) {
            return response()->json(['status' => 'success', 'message' => 'Email verified successfully!']);
        } else {
            return response()->json('Invalid verification code!', 422);
        }
    }
}
