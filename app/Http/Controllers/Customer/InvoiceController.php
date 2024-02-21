<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoices(){
        if(auth()->user()->role == 'sales') {
            $customerIds = User::where('referred', auth()->user()->email)->pluck('id');

            $invoices = Order::with('customer')
                ->whereIn('customer_id', $customerIds)
                ->get();

            return view('portal.customer.invoices.all-invoices', compact('invoices'));
        }

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

        if(auth()->user()->role == 'sales') {
            $customerIds = User::where('referred', auth()->user()->email)->pluck('id');

            $invoices = Order::with('customer')
                ->whereIn('customer_id', $customerIds)
                ->whereBetween('created_at', [$start, $end])
                ->get();
        }
        else {
            $invoices = Order::with('customer')
                ->where('customer_id', auth()->user()->id)
                ->whereBetween('created_at', [$start, $end])
                ->get();
        }

        $html = view('portal.customer.invoices.render-invoice-table', compact('invoices'))->render();

        return response()->json(['status' => true, 'data' => $html]);
    }

    public function manualGenerateInvoice(Request $request){
       // dd($request->all());

        $start = Carbon::parse($request->invoice_start_date)->startOfDay();
        $end = Carbon::parse($request->invoice_end_date)->endOfDay();

        $invoice = Order::with('customer')
            ->where('customer_id', auth()->user()->id)
            ->whereBetween('created_at', [$start, $end])
            ->get();
//dd($invoice);
        $pdf = PDF::loadView('portal.customer.invoices.manual-invoice-generate', compact('invoice'));
        $pdf->setPaper('A4', 'portrait');
//        return $pdf->stream(time().'.pdf');
        return $pdf->download(time().'.pdf');
    }
}
