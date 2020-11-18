<?php

namespace App\Http\Controllers;

use App\ImportHistory;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        foreach ($request->all() as $key => $value) {
            if ('payment_option' != $key && '_token' != $key) {
                $this->updateTemplate($request, $key, $value);
            }
        }

        $setting = Setting::where('meta_key', 'payment_mandatory')->first();
        $setting->meta_value = ('on' == $request->payment_option ? '1' : '0');
        $setting->save();

        return redirect('/setting')->with('status', 'Successfully Updated the Settings & Viber Messages');
    }

    public function updateTemplate($request, $key, $text)
    {
        $setting = Setting::where('meta_key', $key)->first();

        if ($request->hasFile($key.'_img')) {
            $path = $request->file($key.'_img')->store('viber', 'public');
            $value = json_encode([
                'text' => $text,
                'image' => $path,
            ]);
        } else {
            if ($setting) {
                $img = json_decode($setting->meta_value, true);
                $value = json_encode([
                    'text' => $text,
                    'image' => (isset($img['image']) ? $img['image'] : ''),
                ]);
            }
        }

        if ($setting && $value) {
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
        $filename = ImportHistory::where('id', $id)->pluck('file_name');

        return response()->download(storage_path("app/public/history/{$filename[0]}"));
    }

    public function document(Request $request)
    {
        $lang = $request->lang;
        $document = Setting::where('meta_key', "document_{$lang}")->first()->meta_value;

        return view("pages.contract.{$lang}", compact('document'));
    }

    public function updateDocument(Request $request)
    {
        $setting = Setting::where('meta_key', "document_{$request->lang}")->first();
        $setting->meta_value = $request->document;
        $setting->save();

        return response()->json([
            'status' => true,
            'message' => 'Updated Successfully',
        ]);
    }

    public function signatures()
    {
        $contractor_signatures_setting = Setting::where('meta_key', 'contractor_signature')->first();
        $id = $contractor_signatures_setting->id;
        $contractor_signatures_setting = json_decode($contractor_signatures_setting->meta_value, true);
        $contractor_signatures_setting['id'] = $id;

        $witness_signatures_setting = Setting::where('meta_key', 'witness_signature')->first();
        $id = $witness_signatures_setting->id;
        $witness_signatures_setting = json_decode($witness_signatures_setting->meta_value, true);
        $witness_signatures_setting['id'] = $id;

        return view('pages.signatures', compact('contractor_signatures_setting', 'witness_signatures_setting'));
    }

    public function updateSignatures(Request $request)
    {
        $contractor_name = $request->contractor_name;
        $contractor_title = $request->contractor_title;

        $contractor_signatures_setting = Setting::where('meta_key', 'contractor_signature')->first();

        if ($request->hasFile('contractor_sign')) {
            $path = $request->file('contractor_sign')->store('signatures', 'public');
            $value = json_encode([
                'name' => $contractor_name,
                'title' => $contractor_title,
                'image' => $path,
            ]);
        } else {
            if ($contractor_signatures_setting) {
                $img = json_decode($contractor_signatures_setting->meta_value, true);
                $value = json_encode([
                    'name' => $contractor_name,
                    'title' => $contractor_title,
                    'image' => (isset($img['image']) ? $img['image'] : ''),
                ]);
            }
        }

        if ($contractor_signatures_setting && $value) {
            $contractor_signatures_setting->meta_value = $value;
            $contractor_signatures_setting->save();
        }

        $witness_name = $request->witness_name;
        $witness_title = $request->witness_title;

        $witness_signatures_setting = Setting::where('meta_key', 'witness_signature')->first();

        if ($request->hasFile('witness_sign')) {
            $path = $request->file('witness_sign')->store('signatures', 'public');
            $value = json_encode([
                'name' => $witness_name,
                'title' => $witness_title,
                'image' => $path,
            ]);
        } else {
            if ($witness_signatures_setting) {
                $img = json_decode($witness_signatures_setting->meta_value, true);
                $value = json_encode([
                    'name' => $witness_name,
                    'title' => $witness_title,
                    'image' => (isset($img['image']) ? $img['image'] : ''),
                ]);
            }
        }

        if ($witness_signatures_setting && $value) {
            $witness_signatures_setting->meta_value = $value;
            $witness_signatures_setting->save();
        }

        return redirect('/signatures')->with('status', 'Successfully Updated the Signatures');
    }

    public function convertView()
    {
        return view('pages.convert');
    }

    public function convertData(Request $request)
    {
        $input = $request->data;
        $text = explode("\n", str_replace("\r", '', $input));
        $str = null;
        foreach ($text as $t) {
            $t = Str::slug($t, '_');
            $var = "\${$t}";
            $str .= "{{$var}}|";
            echo "{$var} = null; <br />";
        }
        echo $str;
    }
}
