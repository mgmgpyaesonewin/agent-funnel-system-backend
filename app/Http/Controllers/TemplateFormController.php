<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Setting;
use App\Http\Requests\Template;
use App\TemplateForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplateFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCity(Request $req)
    {
        $lang_id = 'my' === $req->lang ? 3 : 1;

        return DB::table('city_descriptions')
            ->select('c_id as value', 'name as text')
            ->where('languages_id', $lang_id)
            ->orderby('text', 'asc')
            ->get();
    }

    public function getTownship(Request $req)
    {
        $city_id = $req->id;
        $lang_id = 'my' === $req->lang ? 3 : 1;

        return DB::table('townships')
            ->where('city_id', $city_id)
            ->join('township_descriptions', 'townships.id', 'township_descriptions.townships_id')
            ->where('language_id', $lang_id)
            ->select('townships_id as value', 'description_name as text')
            ->orderBy('text', 'asc')
            ->get()
        ;
        // $townships = $townships->map(function ($township) {
        //     return [
        //         'city_id' => $township->city_id,
        //         'township_id' => $township->id,
        //         'township_description' => $township->description[0]->description_name,
        //     ];
        // });
    }

    public function index()
    {
        $templates = TemplateForm::orderby('active', 'desc')->get();

        return view('pages.templateform.index', compact('templates'));
    }

    public function getform(Request $req)
    {
        $templates = TemplateForm::where('active', true)->first();

        $applicant = Applicant::where('uuid', $req->id)->whereNull('submitted_date')->where('current_status', 'pre_filter')->where('status_id', 1)->first();
        $term_condition = Setting::where('meta_key', "document_tnc_{$req->lang}")->first()->meta_value;

        if ($applicant) {
            return [
                'template' => $templates,
                'applicant' => $applicant,
                'term_condition' => $term_condition
            ];
        }

        return response('[]', 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.templateform.create');
    }

    public function activate(Request $req)
    {
        TemplateForm::where('id', '!=', $req->id)->update(['active' => false]);
        $temp = TemplateForm::find($req->id);
        $temp->active = true;
        $temp->save();

        return redirect('templateforms');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TemplateForm::create($request->all());

        return redirect('templateforms');
    }

    public function show(TemplateForm $TemplateForm)
    {
        //
        // dd($TemplateForm);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\TemplateForm $templateForm
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($templateForm)
    {
        $templateForm = TemplateForm::findOrFail($templateForm);

        return view('pages.templateform.edit', compact('templateForm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\TemplateForm        $templateForm
     * @param mixed                    $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Template $request, $id)
    {
        $validated_data = $request->validated();
        $template_detail = TemplateForm::findOrFail($id);
        $active = $template_detail->active;
        $template = collect($template_detail)->except('id');
        foreach ($template as $key => $value) {
            $template[$key] = $validated_data[$key] ?? false;
        }
        $template_detail->update($template->toArray());
        $template_detail->additional_info = $validated_data['additional_info'];
        $template_detail->active = $active;
        $template_detail->save();

        return  redirect('templateforms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\TemplateForm $templateForm
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        $temp = TemplateForm::findorfail($req->id);
        $temp->delete();

        return redirect('templateforms');
    }
}
