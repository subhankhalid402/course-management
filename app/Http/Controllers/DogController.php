<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DogController extends Controller
{
    public $menu = "preference";
    public function index(Request $request)
    {
        $this->data['dogs'] = Dog::with('user')->when($request->preference, function ($Dog) use ($request) {
            $Dog->where('preference', '=', $request->preference);
        })->get();


        if ($request->preference) {
            $this->menu = $this->menu . "_" . $request->preference;
        }

        $this->data['menu'] = $this->menu;

        return view('dogs.list', $this->data);
    }

    public function create()
    {
        $this->data['users'] = User::whereHas('role', function ($Role) {
            $Role->where('code', 'user');
        })->get();

        $this->data['menu'] = $this->menu;
        return view('dogs.create', $this->data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
            'preference' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        Dog::create([
            'name' => $request->name,
            'breed' => $request->breed,
            'preference' => $request->preference,
            'user_id' => $request->user_id,
            'gender' => $request->gender,
            'born_year' => $request->born_year,
            'born_month' => $request->born_month
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Dog Saved successfully'
        ]);
    }

    public function edit(Request $request)
    {
        $this->data['users'] = User::whereHas('role', function ($Role) {
            $Role->where('code', 'user');
        })->get();
        $this->data['dog'] = Dog::find($request->id);
        $this->data['menu'] = $this->menu;
        return view('dogs.edit', $this->data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        Dog::where('id', $request->id)->update([
            'name' => $request->name,
            'breed' => $request->breed,
            'preference' => $request->preference,
            'user_id' => $request->user_id,
            'gender' => $request->gender,
            'born_year' => $request->born_year,
            'born_month' => $request->born_month
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Dog saved successfully'
        ]);
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        $User = Dog::find($request->id);
        if (!$User) {
            return response()->json([
                'status' => false,
                'message' => 'Dog not found'
            ]);
        }
        $User->delete();

        return response()->json([
            'status' => true,
            'message' => 'Dog deleted successfully'
        ]);

    }
}
