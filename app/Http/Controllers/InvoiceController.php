<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function home(Request $request)
    {
        if (empty($request->start)) {
            $invoices = Invoice::get(100)->paginate(25);
        } else {
            $start_date = $request->start;
            if (!empty($request->end)) {
                $end_date = $request->end;
            } else {
                $end_date = date("Y-m-d");
            }
            $invoices = Invoice::whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date)->with('user')->latest()->get()->paginate(25);
        }

        return view('pages.invoice.index', compact('invoices'));
    }
}
