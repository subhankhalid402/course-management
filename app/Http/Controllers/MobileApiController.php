<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Chat;
use App\Models\Dog;
use App\Models\Favourite;
use App\Models\Role;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MobileApiController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'phone_code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $User = User::with(['dog', 'attachment'])->where('phone', $request->phone)->first();

        // check if User exist or not
        if ($User) {
            $token = $User->createToken('user')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Logged in. Already User Exist.',
                'user' => $User,
                'token' => ['token' => $token]
            ])->header('Cache-Control', 'private')->header('Authorization', $token);
        }


        $User = User::create([
            'phone' => $request->phone,
            'phone_code' => $request->phone_code,
        ]);

        $this->generateOtp($User);

        return response()->json([
            'status' => true,
            'message' => 'Send Otp successfully. check your mobile',
        ]);
    }

    public function generateOtp($User)
    {
        $otp = rand(100000, 999999);

        SmsService::sendSms($User['phone'], 'This is your Otp: ' . $otp);

        User::where('id', $User->id)->update(['otp' => $otp]);


        //Sending message ends here
//        return response()->json([
//            'status' => true,
//            'message' => ''
//        ]);
    }

    public function verifyOpt(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'phone' => 'required',
//            'otp' => 'required',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'status' => false,
//                'message' => $validator->errors()->first()
//            ]);
//        }

        $User = User::where('phone', $request->phone)->first();

        // check if User exist or not
//        if (empty($User) || $User->otp != $request->otp) {
//            return response()->json([
//                'status' => false,
//                'message' => 'Wrong Verification Code. Try again!',
//            ]);
//        }

        $token = $User->createToken('user')->plainTextToken;

        $User->otp = null;
        $User->save();

        return response()->json([
            'status' => true,
            'message' => 'Logged in',
            'user' => $User,
            'token' => ['token' => $token]
        ])->header('Cache-Control', 'private')->header('Authorization', $token);
    }

    public function storeDogAndOwnerName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'owner_name' => 'required',
            'dog_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $role_id = Role::where('code', 'user')->first()->id;

        $User = User::find(Auth::id());
        $User->name = $request->owner_name;
        $User->role_id = $role_id;
        $User->save();

        Dog::create([
            'name' => $request->name,
            'user_id' => $User->id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Owner & Dog Name Saved Successfully'
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $User = User::find(Auth::id());
        $User->name = $request->name;
        $User->save();

        $Dog = Dog::where('user_id', Auth::id())->first();
        $Dog->breed = $request->dog_breed;
        $Dog->save();

        $image = $request->file('image');
        if ($image) {
            $file_name = Str::random(10);
            $type = $image->getClientOriginalExtension();
            $image_name = $file_name . '.' . $type;
            $image->move(public_path('uploads/dogs'), $image_name);
        } else {
            $image_name = '';
        }

        if ($User && $image) {
            Attachment::create([
                'name' => $image_name,
                'file_name' => $file_name,
                'type' => $type,
                'object' => 'Dog',
                'object_id' => $Dog->id,
                'context' => 'dog-image'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Profile Update Successfully'
        ]);
    }

    public function storeDogAndOwnerImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'owner_image' => 'required',
            'dog_image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $User = User::find(Auth::id());

        $Dog = Dog::where('user_id', Auth::id())->first();

        // store owner and dog image
        $owner_image = $request->file('owner_image');
        if ($owner_image) {
            $file_name = Str::random(10);
            $type = $owner_image->getClientOriginalExtension();
            $owner_image_name = $file_name . '.' . $type;
            $owner_image->move(public_path('uploads/owner-and-dog'), $owner_image_name);
        } else {
            $owner_image_name = '';
        }

        if ($User && $owner_image) {
            Attachment::create([
                'name' => $owner_image_name,
                'file_name' => $file_name,
                'type' => $type,
                'object' => 'User',
                'object_id' => $User->id,
                'context' => 'owner-and-dog-image'
            ]);
        }

        // store dog image
        $image = $request->file('dog_image');
        if ($image) {
            $file_name = Str::random(10);
            $type = $image->getClientOriginalExtension();
            $image_name = $file_name . '.' . $type;
            $image->move(public_path('uploads/dogs'), $image_name);
        } else {
            $image_name = '';
        }

        if ($User && $image) {
            Attachment::create([
                'name' => $image_name,
                'file_name' => $file_name,
                'type' => $type,
                'object' => 'Dog',
                'object_id' => $Dog->id,
                'context' => 'dog-image'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Images Saved Successfully'
        ]);
    }

    public function storeDogAge(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'month' => 'required',
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $Dog = Dog::where('user_id', Auth::id())->update([
            'born_month' => $request->month,
            'born_year' => $request->year,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Saved Successfully'
        ]);

    }

    public function storeLatLong(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        User::where('id', Auth::id())->update([
            'latitude' => $request->latitude,
            'longitude' => $request->londitude,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Saved Successfully'
        ]);

    }

    public function storeDogGender(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gender' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $Dog = Dog::where('user_id', Auth::id())->update([
            'gender' => $request->gender
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Gender Save Successfully'
        ]);

    }

    public function storeDogBreed(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'breed' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $Dog = Dog::where('user_id', Auth::id())->update([
            'breed' => $request->breed
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Breed Save Successfully'
        ]);

    }

    public function storeDogPreference(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'preference' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $Dog = Dog::where('user_id', Auth::id())->update([
            'preference' => $request->preference
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Preference Save Successfully'
        ]);
    }

    public function addToFavourites(Request $request)
    {
        $dog_id = $request->dog_id;
        $validation_arr = [
            'dog_id' => $dog_id,
        ];

        $Validator = Validator::make($validation_arr, [
            'dog_id' => 'required|exists:dogs,id',
        ]);

        if ($Validator->fails()) {
            $error = $Validator->errors()->first();
            return response()->json([
                'status' => false,
                'message' => "Invalid Selection",
            ]);
        }

        $Favourite = Favourite::where([
            'dog_id' => $dog_id,
            'user_id' => Auth::id(),
        ])->first();

        if (!empty($Favourite)) {
            return response()->json([
                'status' => false,
                'message' => "Already exists",
            ]);
        }

        Favourite::create([
            'dog_id' => $dog_id,
            'user_id' => Auth::id(),
        ]);


        //init the chat
        $Dog = Dog::where('id', $dog_id)->first();
        if ($Dog) {
            $login_user_dog_id = Dog::where('user_id', Auth::id())->first()->id;
            $is_login_user_dog_favourite = Favourite::where('user_id', $Dog->user_id)->where('dog_id', $login_user_dog_id)->first();

            if ($is_login_user_dog_favourite) {
                Chat::create([
                    'status' => 'accepted',
                    'second_user_id' => $Dog->user_id,
                    'first_user_id' => Auth::id(),
                    'initiated_by' => Auth::id(),
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => "Added to favourites",
        ]);

    }

    public function removeFromFavourites(Request $request)
    {
        $dog_id = $request->dog_id;

        $validation_arr = [
            'dog_id' => $dog_id,
        ];

        $Validator = Validator::make($validation_arr, [
            'dog_id' => 'required|exists:dogs,id',
        ]);

        if ($Validator->fails()) {
            $error = $Validator->errors()->first();
            return response()->json([
                'status' => false,
                'message' => "Invalid Selection",
            ]);
        }

        $Favourite = Favourite::where([
            'dog_id' => $dog_id,
            'user_id' => Auth::id(),
        ])->first();

        if (!empty($Favourite)) {
            $Favourite->delete();

            return response()->json([
                'status' => true,
                'message' => "Removed",
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "Failed",
        ]);

    }

    public function getDogMatchesList()
    {
        $Dog = Dog::where('user_id', Auth::id())->first();

        if ($Dog) {
            $MatchersDogs = Dog::where('preference', $Dog->preference)->where('user_id', '!=', Auth::id());

            if ($Dog->preference == 'mate') {
                $MatchersDogs->where('gender', '!=', $Dog->gender);
            }

            return response()->json([
                'status' => true,
                'data' => $MatchersDogs->get()
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'invalid request',
        ]);
    }

}
