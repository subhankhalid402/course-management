<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function viewPdf(Request $request)
{
    $payment = Payment::findOrFail($request->id);

    if (empty($payment->id)) {
        return response()->json([
            'status' => false,
            'message' => 'Invoice number is not set for this payment.'
        ]);
    }
    $user = User::whereHas('role', function ($query) {
        $query->where('code', 'student');
    })->firstOrFail();

    $pdf = PDF::loadView('pdf.invoice', ['pay' => $payment, 'student' => $user], [], [
        'title' => 'Invoice',
        'margin_top' => 10
    ]);

    $filePath = public_path('uploads/invoice/' . $payment->id . '.pdf');

    $pdf->save($filePath);

    $openPath = asset('uploads/invoice/' . $payment->id . '.pdf') . '?v=' . date('ymdhis');

    return $pdf->stream('3.pdf');
}

        // $payments = Payment::all();
        // $data = [
        //     'title' => 'Invoice',
        //     'payment' => $payments,
        // ];

        // $pdf = PDF::loadView('pdf.invoice', $data);

        // return $pdf->stream('invoice.pdf');
        
        //     PDF::loadView('invoice.invoice', ['res' => Restaurant::find(1), 'sale' => $Sale], [], [
        //         'title' => 'Invoice',
        //         'margin_top' => 10
        //     ])->save(public_path() . '/uploads/invoice/' . $Sale->invoice_no . '.pdf');
        
        //     $open_path = env('BASE_URL') . 'public/uploads/invoice/' . $Sale->invoice_no . '.pdf?v=' . date('ymdhis');
        
        //     return response()->json([
        //         'status' => true,
        //         'pdf_link' => $open_path
        //         ]);
    }
   
