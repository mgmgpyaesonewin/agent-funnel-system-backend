<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    public function index(){

        $payment = Setting::where('meta_key', 'payment_mandatory')->pluck('meta_value')->first();
        $msg_templates = Setting::where('meta_key', 'like', '%msg%')->get();
        
        return view('pages.setting', compact('payment', 'msg_templates'));
    }

    public function update(Request $request)
    {
        $setting = Setting::where('meta_key', 'cv_form_msg')->first();
        $setting->meta_value = $request->cv_form_msg;
        $setting->save();

        $setting = Setting::where('meta_key', 'dna_test_msg')->first();
        $setting->meta_value = $request->dna_test_msg;
        $setting->save();

        $setting = Setting::where('meta_key', 'interview_msg')->first();
        $setting->meta_value = $request->interview_msg;
        $setting->save();

        $setting = Setting::where('meta_key', 'elearning_msg')->first();
        $setting->meta_value = $request->elearning_msg;
        $setting->save();

        $setting = Setting::where('meta_key', 'payment_msg')->first();
        $setting->meta_value = $request->payment_msg;
        $setting->save();

        $setting = Setting::where('meta_key', 'exam_msg')->first();
        $setting->meta_value = $request->exam_msg;
        $setting->save();   
        
        $setting = Setting::where('meta_key', 'license_msg')->first();
        $setting->meta_value = $request->license_msg;
        $setting->save();    

        $setting = Setting::where('meta_key', 'contract_msg')->first();
        $setting->meta_value = $request->contract_msg;
        $setting->save();

        $setting = Setting::where('meta_key', 'payment_mandatory')->first();
        $setting->meta_value = ($request->payment_option == 'on' ? '1' : '0');
        $setting->save();

        return redirect('/setting')->with('status', 'Successfully Updated the Settings & Viber Messages');
    }
}

