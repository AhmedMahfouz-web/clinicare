<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $prices = Price::all();

        return view('pages.pricing.index', compact('prices'));
    }

    public function edit(Price $price)
    {
        return view('pages.pricing.edit', compact('price'));
    }

    public function update(Request $request, Price $price)
    {
        $price->update([
            'price' => $request->price
        ]);

        return redirect()->route('show prices')->with('success', 'تم اضافة السعر بنجاح');
    }

    public function get_prices()
    {
        $prices = Price::all();

        return response()->json([
            'status' => 'success',
            'prices' => $prices
        ]);
    }
}
