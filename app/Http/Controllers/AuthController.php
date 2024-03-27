<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorProfession;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Webpatser\Uuid\Uuid;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login_user', 'login_doctor', 'register_user', 'register_doctor', 'forget_password', 'change_password', 'forget_password_doctor', 'change_password_doctor']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login_user(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();
        if ($user->email_verified_at == null || empty($user->email_verified_at)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Verify Email first',
            ]);
        }

        $token = auth('api')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    } //

    public function login_doctor(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = auth('doctor')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $doctor = auth('doctor')->user();
        return response()->json([
            'status' => 'success',
            'doctor' => $doctor,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    } //

    public function register_user(Request $request)
    {
        // Validate user input
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6',
            'age' => 'required',
            'phone' => 'unique:users',
        ]);


        // Create a new user
        $user = User::create([
            'id' => check_uuid('App\Models\User', Uuid::generate()),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'phone' => $request->phone,
            'age' => $request->age,
        ]);
        $data = array('name' => $user->first_name . ' ' . $user->last_name, 'link' => 'clinicareapp.com/verify/' . $user->id);
        Mail::send('mail', $data, function ($message) use ($user) {
            $message->to($user->email, 'Verify Account')->subject('Verify Your Account');
            $message->from('info@clinicareapp.com', 'Clinicare');
        });

        // Send email verification notification
        // $user->sendEmailVerificationNotification();

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully. Check your email for verification.'
        ]);
    } //

    // Doctor registration
    public function register_doctor(Request $request)
    {
        // Validate doctor input
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'work_at' => 'required|string|max:255',
            'bio' => 'required|string',
            'phone' => 'required|unique:doctors',
            'profession' => 'required',
            'email' => 'required|string|email|unique:doctors|max:255',
            'password' => 'required|string|min:8',
        ]);

        if (!empty($request->certificate)) {
            $certificate_name = time() . '.' . $request->certificate->extension();
            $request->certificate->move(public_path('certificates/'), $certificate_name);
        } else {
            $certificate_name = null;
        }

        if (!empty($request->cv)) {
            $cv_name = time() . '.' . $request->cv->extension();
            $request->cv->move(public_path('cv/'), $cv_name);
        } else {
            $cv_name = null;
        }

        if (!empty($request->image)) {
            $image_name = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/doctors'), $image_name);
        } else {
            $image_name = null;
        }

        // Create a new admin
        $doctor = Doctor::create([
            'id' => check_uuid('App\Models\Doctor', Uuid::generate()),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'profession' => $request->profession,
            'work_at' => $request->work_at,
            'bio' => $request->bio,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'degree' => $request->degree,
            'country' => $request->country,
            'experience' => $request->experience,
            'university' => $request->university,
            'cv' => 'public/cv/' . $cv_name,
            'image' => 'public/images/doctors/' . $image_name,
            'certificate' => 'public/certificates/' . $certificate_name,
        ]);
        $data = array('name' => $doctor->first_name . ' ' . $doctor->last_name, 'link' => 'clinicareapp.com/verify/doctor/' . $doctor->id);
        Mail::send('mail', $data, function ($message) use ($doctor) {
            $message->to($doctor->email, 'Verify Account')->subject('Verify Your Account');
            $message->from('info@clinicareapp.com', 'Clinicare');
        });
        // $doctor->sendEmailVerificationNotification();

        return response()->json([
            'status' => 'success',
            'message' => 'Doctor registered successfully.'
        ]);
    } //

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    } //

    public function refresh()
    {
        $user = Auth::user();

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    } //


    public function forget_password(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (empty($user)) {
            return response()->json([
                'status' => 'error',
                'message' => 'This email isn\'t right',
            ]);
        }

        $data = array('name' => $user->first_name . ' ' . $user->last_name, 'link' => 'clinicareapp.com/change_password/' . $user->id);
        Mail::send('mail', $data, function ($message) use ($user) {
            $message->to($user->email, 'Change Password')->subject('Change Password');
            $message->from('info@clinicareapp.com', 'Clinicare');
        });

        return response()->json([
            'status' => 'success',
            'message' => 'email has been sent succesfully',
        ]);
    }

    public function change_password(Request $request, User $user)
    {
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'password changed successfully'
        ]);
    }

    public function forget_password_doctor(Request $request)
    {
        $doctor = Doctor::where('email', $request->email)->first();
        if (empty($doctor)) {
            return response()->json([
                'status' => 'error',
                'message' => 'This email isn\'t right',
            ]);
        }

        $data = array('name' => $doctor->first_name . ' ' . $doctor->last_name, 'link' => 'clinicareapp.com/change_password_doctor/' . $doctor->id);
        Mail::send('mail', $data, function ($message) use ($doctor) {
            $message->to($doctor->email, 'Change Password')->subject('Change Password');
            $message->from('info@clinicareapp.com', 'Clinicare');
        });

        return response()->json([
            'status' => 'success',
            'message' => 'email has been sent succesfully',
        ]);
    }

    public function change_password_doctor(Request $request, Doctor $doctor)
    {
        $doctor->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'password changed successfully'
        ]);
    }
}
