<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorProfession;
use App\Models\Profession;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function show_all_doctors()
    {
        $doctors = Doctor::all();

        return response()->json([
            'message' => 'success',
            'doctor' => $doctors
        ]);
    }

    public function show_all_doctors_home()
    {
        $doctors = Doctor::take(6)->get();

        return response()->json([
            'message' => 'success',
            'doctors' => $doctors
        ]);
    }

    public function show_doctor(Doctor $doctor)
    {
        return response()->json([
            'message' => 'success',
            'doctor' => $doctor
        ]);
    }

    public function profile()
    {
        $doctor = auth()->guard('doctor')->user();
        return response()->json([
            'status' => 'success',
            'doctor' => $doctor
        ]);
    }

    // Edit doctor profile
    public function edit_doctor()
    {
        $doctor = auth()->guard('doctor')->user();
        $professions = Profession::all();
        return response()->json([
            'message' => 'success',
            'doctor' => $doctor,
            'professions' => $professions,
        ]);
    }

    // Update doctor profile
    public function update_doctor(doctor $doctor, Request $request)
    {

        // Validate input
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'bio' => 'required|string',
            'phone' => 'required|',
            'work_at' => 'required|string|max:255',
            'profession' => 'required',
        ]);

        if ($doctor->id == auth()->guard('doctor')->user()->id) {

            if (!empty($request->certificate)) {
                $certificate_name = time() . '.' . $request->certificate->extension();
                $request->certificate->move(public_path('certificates/'), $certificate_name);
            } else {
                $certificate_name = $doctor->certificate;
            }

            if (!empty($request->cv)) {
                $cv_name = time() . '.' . $request->cv->extension();
                $request->cv->move(public_path('certificates/'), $cv_name);
            } else {
                $cv_name = $doctor->cv;
            }

            if (!empty($request->image)) {
                $image_name = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/doctors'), $image_name);

                $doctor->update([
                    'image' => 'public/images/doctors/' .  $image_name
                ]);
            }

            // Update doctor
            $doctor->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'bio' => $request->bio,
                'phone' => $request->phone,
                'work_at' => $request->work_at,
                'profession' => $request->profession,
                'degree' => $request->degree,
                'experience' => $request->experience,
                'university' => $request->university,
                'country' => $request->country,
                'cv' => $cv_name,
                'certificate' => 'certificates/' . $certificate_name,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'doctor profile updated successfully',
            'doctor' => $doctor,
        ]);
    }

    // Destroy (delete) doctor profile
    public function destroy_doctor(Doctor $doctor)
    {
        // Delete doctor
        $doctor->delete();

        return response()->json(['message' => 'doctor profile deleted successfully']);
    }

    // Search Doctors
    public function search($name, $profession)
    {

        // Start with a base query
        $query = Doctor::query();

        if ($profession != 'null') {
            $query->where('profession', 'like', '%' . $profession . '%');
        }

        // Apply search query if provided
        if ($name != 'null') {
            $query->where(function ($q) use ($name) {
                $q->where('first_name', 'like', '%' . $name . '%')
                    ->orWhere('last_name', 'like', '%' . $name . '%')
                    ->orWhere('bio', 'like', '%' . $name . '%')
                    ->orWhere('profession', 'like', '%' . $name . '%');
            });
        }

        $doctors = $query->get();

        return response()->json([
            'status' => 'success',
            'doctors' => $doctors
        ]);
    }

    public function index()
    {
        $doctors = Doctor::latest()->paginate(25);

        return view('pages.doctors.index', compact('doctors'));
    }

    public function destroy(Request $request, Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('show doctors')->with('success', 'تم حذف الدكتور بنجاح');

        return back();
    }

    public function show(Doctor $doctor)
    {
        return view('pages.doctors.show', compact('doctor'));
    }
}
