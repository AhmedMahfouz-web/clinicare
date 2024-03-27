<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Price;
use App\Models\Profession;
use App\Models\Reservation;
use App\Models\Test;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::latest()->paginate(25);
        return view('pages.reservations.index', compact('reservations'));
    }

    public function reserved()
    {
        $reservation = Reservation::where('doctor_comment', '!=', null)->with(['user', 'doctor'])->latest()->get();

        return view('pages.reservations.answered', compact('reservations'));
    }

    public function create()
    {
        $hospitals = Hospital::all();
        $tests = Test::all();

        return response()->json([
            'status' => 'success',
            'hospitals' => $hospitals,
            'tests' => $tests,
        ]);
    }

    public function store(Request $request)
    {
        $price = Price::where('model', 'meeting')->first();

        if (!empty($request->transaction)) {
            $transaction_name = time() . '.' . $request->transaction->extension();

            $request->transaction->move(public_path('images/transaction'), $transaction_name);

            Invoice::create([
                'user_id' => auth()->user()->id,
                'transaction' => 'public/images/transaction/' . $transaction_name,
                'price' => $price,
                'type' => 'reservation'
            ]);
        }

        $reservation = Reservation::create([
            'user_id' => auth()->user()->id,
            'hospital_id' => $request->hospital_id,
            'notes' => $request->notes,
            'rays' => $request->rays,
            'rays_notes' => $request->rays_notes,
            'analysis' => $request->analysis,
            'analysis_notes' => $request->analysis_notes,
            'transaction' => 'public/images/transaction/' . $transaction_name,
        ]);


        return response()->json([
            'status' => 'success',
        ]);
    }

    public function show_reserved_dashboard(Reservation $reservation)
    {
        $reservation->load('user', 'hospital');
        return view('pages.reservations.show', compact('reservation'));
    }

    public function reserve(Request $request, Reservation $reservation)
    {
        if ($reservation->status != $request->status) {
            if (!empty($request->date)) {
                $reservation->update([
                    'status' => $request->status,
                    'date' => $request->date
                ]);

                $notification = Notification::create([
                    'receiver_id' => $reservation->user_id,
                    'model' => 'reservation',
                    'model_id' => $reservation->id,
                    'body' => 'تم تغيير حالة طلب اجراء الفحوصات الخاص بك الي ' . $reservation->status,
                ]);

                return redirect()->route('show reservations')->with('success', 'تم حجز الموعد بنجاح');
            }

            $reservation->update([
                'status' => $request->status,
            ]);

            $notification = Notification::create([
                'receiver_id' => $reservation->user_id,
                'model' => 'reservation',
                'model_id' => $reservation->id,
                'body' => 'تم تغيير حالة طلب اجراء الفحوصات الخاص بك الي ' . $reservation->status,
            ]);

            return redirect()->route('show reservations')->with('success', 'تم تغيير الحالة بنجاح');
        }

        return redirect()->route('show reservations')->with('error', 'لم يحجز الموعد بسبب مشكلة ما');
    }

    public function get_reservation(Reservation $reservation)
    {
        if (auth()->user()->id == $reservation->user_id) {
            $reservation->load(['user', 'hospital']);
            return response()->json([
                'status' => 'success',
                'reservation' => $reservation,
            ]);
        }
    }

    public function get_all_reservations()
    {
        $reservation = Reservation::where('user_id', auth()->user()->id)->with(['user', 'hospital'])->get();
        return response()->json([
            'status' => 'success',
            'reservation' => $reservation,
        ]);
    }
}
