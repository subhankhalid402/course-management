<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Role;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PDF;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['courses', 'batch'])->whereHas('role', function ($role) {
            $role->where("code", "student");
        })->get();
        return view('students.list', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $courses = Course::all();
        $batches = Batch::all();

        return view('students.create', compact('batches', 'courses', 'roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $role = Role::firstWhere('code', 'student');

        $user = User::create([
            'batch_id' => $request->batch,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
            'address' => $request->address,
            'notes' => $request->notes,
            'education' => $request->education,
            'dob' => $request->dob,
            'admission_date' => $request->admission_date,
            'gender' => $request->gender,
            'cnic' => $request->cnic,
            'city' => $request->city,
            'state' => $request->state,
            'created_by' => Session::get("user")->id,
        ]);

        if ($request->courses) {
            $user->courses()->attach($request->courses);
        }

        return response()->json([
            'status' => true,
            'message' => 'User saved successfully',
            'user' => $user, // Optionally return the saved user data
        ]);
    }

    public function edit($id)
    {
        $user = User::with(['courses', 'batch'])->find($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }



    public function forminfo(Request $request)
    {
        // Retrieve student information based on student_id query parameter
        $studentId = $request->query('student_id');
        $user = User::whereHas('role', function ($query) {
            $query->where('code', 'student');
        })->where('id', $studentId)->first();
    
        if ($user) {
            $courses = $user->courses;
        } else {
            $courses = collect(); // Empty collection if user not found
        }
    
        // Generate PDF with student and courses data
        $pdf = PDF::loadView('pdf.forminfo', [
            'student' => $user,
            'courses' => $courses,
        ], [], [
            'title' => 'Student Information',
            'margin_top' => 10
        ]);
    
        // Stream the generated PDF as a response
        return $pdf->stream('student_information.pdf');
    }
    


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'nullable|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->notes = $request->notes;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Sync courses and update batch if provided
        if ($request->courses) {
            $user->courses()->sync($request->courses);
        } else {
            $user->courses()->detach(); // Remove all courses if none provided
        }

        if ($request->batch_id) {
            $user->batch_id = $request->batch_id;
            $user->save();
        } else {
            $user->batch_id = null;
            $user->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'User updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ]);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully'
        ]);
    }
}
