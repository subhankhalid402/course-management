<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::get();
        return view('batches.list', compact('batches'));
    }

    public function create()
    {
        $batches = Batch::all();
        
        return view('batches.create', compact('batches'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
    
    
        $batch = Batch::create([
            'title' => $request->title,

        ]);
    
        return response()->json([
            'status' => true,
            'message' => 'Batch saved successfully',
            'batch' => $batch, // Optionally return the saved user data
        ]);
    }
    
    public function edit($id)
    {
        $user = User::with(['courses', 'batch'])->find($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
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
