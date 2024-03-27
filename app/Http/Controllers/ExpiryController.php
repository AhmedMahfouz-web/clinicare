<?php

namespace App\Http\Controllers;

use App\Models\Expiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ExpiryController extends Controller
{


    public function status_page()
    {
        return view('pages/expiry');
    }

    public function change_status(Request $request)
    {
        $expiry = Expiry::first();

        $expiry->update([
            'expired' => Hash::make($request->passcode),
        ]);

        return redirect()->route('dashboard');
    }
}
