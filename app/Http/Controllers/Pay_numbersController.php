<?php

namespace App\Http\Controllers;

use App\Models\Pay_numbers;
use Illuminate\Http\Request;
use Illuminate\View\ViewName;

class Pay_numbersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pay_numbers = Pay_numbers::all();

        return view('pages.bank.index', compact('pay_numbers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $number = Pay_numbers::create([
            'bank' => $request->bank,
            'number' => $request->number,
            'iban' => $request->iban,
        ]);

        return redirect()->route('show numbers')->with('success', 'تم اضافة الحساب بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pay_numbers $pay_numbers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pay_numbers $pay_numbers)
    {
        return view('pages.bank.edit', compact('pay_numbers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pay_numbers $pay_numbers)
    {
        $pay_numbers->update([
            'bank' => $request->bank,
            'number' => $request->number,
            'iban' => $request->iban,
        ]);
        return redirect()->route('show numbers')->with('success', 'تم تعديل الحساب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pay_numbers $pay_numbers)
    {
        $pay_numbers->delete();

        return redirect()->route('show numbers')->with('success', 'تم ازالة الحساب بنجاح');
    }

    public function get_banks()
    {
        $numbers = Pay_numbers::all();

        return response()->json([
            'status' => 'success',
            'numbers' => $numbers
        ]);
    }
}
