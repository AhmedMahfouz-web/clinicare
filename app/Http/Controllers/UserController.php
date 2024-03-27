<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show_user(User $user)
    {

        return response()->json([
            'message' => 'success',
            'user' => $user
        ]);
    }

    // Edit user profile
    public function edit_user(User $user)
    {

        return response()->json([
            'message' => 'success',
            'user' => $user,
        ]);
    }

    // Update user profile
    public function update_user(User $user, Request $request)
    {

        // Validate input
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',


        ]);

        if (!empty($request->image)) {
            $image_name = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/users'), $image_name);

            $user->update([
                'image' => 'public/images/users/' .  $image_name
            ]);
        }
        // Update user
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'gender' => $request->gender,
            'age' => $request->age,
        ]);

        return response()->json(['message' => 'User profile updated successfully']);
    }

    // Destroy (delete) user profile
    public function destroy_user(User $user)
    {
        // Delete user
        $user->delete();

        return response()->json(['message' => 'User profile deleted successfully']);
    }

    public function index()
    {
        $users = user::latest()->paginate(25);

        return view('pages.user.index', compact('users'));
    }


    public function show(user $user)
    {
        return view('pages.user.show', compact('user'));
    }
}
