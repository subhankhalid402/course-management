<?php

namespace App\Http\Controllers;


use App\Models\Course;
use App\Models\Payment;
use App\Models\Attachment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('user.courses')->get();
        // dd($payments->toArray());
        return view('payments.list', compact('payments'));
    }

    public function create()
    {

        $users = User::all();
        $courses = Course::all();

        return view('payments.create', compact('courses', 'users'));
    }


    public function store(Request $request)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id',
            'course_id' => 'nullable|exists:courses,id',
            'amount' => 'nullable|numeric',
            'status' => 'nullable|in:paid,pending',
            'payment_method' => 'nullable',
            'paid_by' => 'nullable',
            'attachments' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }


        $payment = Payment::create([
            'user_id' => $request->student_id,
            'course_id' => $request->course_id,
            'amount' => $request->amount,
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'paid_by' => $request->paid_by,
            'paid_to' => $request->paid_to,
        ]);


        $image_name = '';
        $file_name = '';
        $type = '';

        $image = $request->file('image');
        if ($image) {
            $file_name = Str::random(10);
            $type = $image->getClientOriginalExtension();
            $image_name = $file_name . '.' . $type;
            $image->move(public_path('uploads/payments'), $image_name);
        }


        if ( $image) {
            Attachment::create([
                'name' => $image_name,
                'file_name' => $file_name,
                'type' => $type,
                'object' => 'Payment',
                'object_id' => $payment->id, // Store payment ID instead of user ID
                'context' => 'paymentAttachment'
            ]);
        }


        $user = User::whereHas('role', function ($query) {
            $query->where('code', 'student');
        })->where('id' , $payment->user_id)->first();

        $courses = $user->courses;

        // dd($courses->toArray());

        // $course = User::with('user.courses')->get();
        if ($user) {
            $courses = $user->courses; 
        } else {
            $courses = collect();
        }
    
        $pdf = PDF::loadView('pdf.invoice', ['pay' => $payment, 'student' => $user , 'course' => $courses], [], [
            'title' => 'Invoice',
            'margin_top' => 10
        ]);
    
        $filePath = public_path('uploads/invoice/' . $payment->id . '.pdf');
    
        $pdf->save($filePath);
    
        $openPath = asset('uploads/invoice/' . $payment->id . '.pdf') . '?v=' . date('ymdhis');

        return response()->json([
            'status' => true,
            'message' => 'Payment saved successfully',
            'payment' => $payment,
            'path' => $openPath
        ]);
    }

    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return response()->json([
            'status' => true,
            'payment' => $payment,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id',
            'course_id' => 'nullable|exists:courses,id',
            'amount' => 'nullable|numeric',
            'status' => 'nullable|in:paid,pending',
            'payment_method' => 'nullable|string',
            'paid_by' => 'nullable|string',
            'attachments' => 'nullable|json',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $payment = Payment::findOrFail($id);
        $payment->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Payment updated successfully',
            'payment' => $payment,
        ]);
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Payment deleted successfully',
        ], 204);
    }
}
