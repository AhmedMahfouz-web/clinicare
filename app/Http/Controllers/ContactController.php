<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send_message(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'phone' => 'numeric',
            'message' => 'string',
            'email' => 'email',
        ]);

        $message = contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'message' => $request->message,
            'email' => $request->email
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function index()
    {
        $messages = contact::latest()->paginate('25');

        return view('pages.contact.index', compact('messages'));
    }

    public function show(contact $message)
    {
        return view('pages.contact.show', compact('message'));
    }
}
