<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\Dog;
use App\Models\PrivacyPolicy;
use App\Models\TermsAndCondition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupportController extends Controller
{
    public $menu = "support";
    public function termsAndConditions()
    {
        $TermsAndConditions = TermsAndCondition::first();

        $this->data['terms'] = $TermsAndConditions;
        $this->data['menu'] = "terms_and_conditions";

        return view('support.terms_and_conditions', $this->data);
    }

    public function updateTermsAndConditions(Request $request)
    {
        $validator = Validator::make($request->all(), [

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        TermsAndCondition::updateORCreate([
            'id' => $request->id,
        ],[
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Terms and Conditions updated successfully'
        ]);
    }

    public function privacyPolicy()
    {
        $PrivacyPolicy = PrivacyPolicy::first();

        $this->data['policy'] = $PrivacyPolicy;
        $this->data['menu'] = "privacy_policy";

        return view('support.privacy_policy', $this->data);
    }

    public function updatePrivacyPolicy(Request $request)
    {
        $validator = Validator::make($request->all(), [

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        PrivacyPolicy::updateORCreate([
            'id' => $request->id,
        ],[
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Privacy Policy updated successfully'
        ]);
    }

    public function contactUs(Request $request)
    {
        $this->data['quries'] = ContactUs::get();

        $this->data['menu'] = "contact_us";

        return view('support.contact_us', $this->data);
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
