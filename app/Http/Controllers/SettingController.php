<?php

namespace App\Http\Controllers;

use App\Setting;
use App\ImportHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $payment = Setting::where('meta_key', 'payment_mandatory')->pluck('meta_value')->first();
        $msg_templates = Setting::where('meta_key', 'like', '%msg%')->get();

        return view('pages.setting', compact('payment', 'msg_templates'));
    }

    public function update(Request $request)
    {
        foreach($request->all() as $key => $value) {
            if($key != "payment_option" && $key != "_token")
                $this->updateTemplate($request, $key, $value);
        
        }

        $setting = Setting::where('meta_key', 'payment_mandatory')->first();
        $setting->meta_value = ('on' == $request->payment_option ? '1' : '0');
        $setting->save();

        return redirect('/setting')->with('status', 'Successfully Updated the Settings & Viber Messages');
    }

    public function updateTemplate($request, $key, $text)
    {
        $setting = Setting::where('meta_key', $key)->first(); 

        if($request->hasFile($key.'_img'))
        {
            $path = $request->file($key.'_img')->store('viber', 'public');
            $value = json_encode([
                'text' => $text,
                'image' => $path
            ]);
        }
        else
        {
            if($setting)
            {
                $img = json_decode( $setting->meta_value, true);
                $value = json_encode([
                    'text' => $text,
                    'image' => (isset($img['image']) ? $img['image'] : '')
                ]);
            }
        }
        
        if($setting && $value)
        {
            $setting->meta_value = $value;
            $setting->save();
        }
        
    }

    public function remove_viber_img($id)
    {
        $setting = Setting::find($id);

        $jsonArray = json_decode($setting->meta_value);
       
        Storage::delete($jsonArray->image);

        unset($jsonArray->image);

        $setting->meta_value = json_encode($jsonArray);
        $setting->save();

        return redirect()->back();
    }

    public function history()
    {
        $files = ImportHistory::orderby('id', 'desc')->get();
        return view('pages.import_history', compact('files'));
    }

    public function download_history($id)
    {
        $filename = ImportHistory::where('id',$id)->pluck('file_name');
        return response()->download(storage_path("app/public/history/{$filename[0]}"));
    }
}
