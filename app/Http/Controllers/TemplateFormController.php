<?php

namespace App\Http\Controllers;

use App\Applicant;
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
        $lang_id = $req->lang === 'my' ? 3 : 1;
        $cities = DB::table('city_descriptions')
            ->select('c_id as value', 'name as text')
            ->where('languages_id', $lang_id)->get();

        return $cities;
    }

    public function getTownship(Request $req)
    {
        $city_id = $req->id;
        $lang_id = $req->lang === 'my' ? 3 : 1;

        $townships = DB::table('townships')
            ->where('city_id', $city_id)
            ->join('township_descriptions', 'townships.id', 'township_descriptions.townships_id')
            ->where('language_id', $lang_id)
            ->select('townships_id as value', 'description_name as text')
            ->get();
        // $townships = $townships->map(function ($township) {
        //     return [
        //         'city_id' => $township->city_id,
        //         'township_id' => $township->id,
        //         'township_description' => $township->description[0]->description_name,
        //     ];
        // });

        return $townships;
    }
    public function index()
    {
        $templates = TemplateForm::all();
        return view('pages.templateform.index', compact('templates'));
    }
    public function getform(Request $req)
    {
        $templates = TemplateForm::where('active', true)->first();

        $applicant = Applicant::where('uuid', $req->id)->first();
        if ($applicant) {
            return [
                'template' => $templates,
                'applicant' => $applicant
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
        //   dd($templateForm);
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
        $Templatedetail = TemplateForm::findOrFail($id);
        $template = collect($Templatedetail)->except('id');
        foreach ($template as $key => $value) {
            $template[$key] = $validated_data[$key] ?? false;
        }
        $Templatedetail->update($template->toArray());

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
