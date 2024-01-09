<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoices(){
        $invoices = Order::with('customer')->where('customer_id', auth()->user()->id)->get();
        return view('portal.customer.invoices.all-invoices', compact('invoices'));
    }

    public function downloadInvoice($id){
        set_time_limit(120);

        $invoiceData = Order::with('customer')->where('id', $id)->first();

        $pdf = PDF::loadView('portal.customer.invoices.generatePDF', compact('invoiceData'));
        $pdf->setPaper('A4', 'portrait');
//        return $pdf->stream(time().'.pdf');
        return $pdf->download(time().'.pdf');
    }

    public function filterInvoiceData(Request $request){

        $start = Carbon::parse($request->start)->startOfDay();
        $end = Carbon::parse($request->end)->endOfDay();

        $invoices = Order::with('customer')
            ->where('customer_id', auth()->user()->id)
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $html = view('portal.customer.invoices.render-invoice-table', compact('invoices'))->render();

        return response()->json(['status' => true, 'data' => $html]);
    }
}
