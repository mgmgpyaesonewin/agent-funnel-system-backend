<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Setting;
use App\Models\TemplateForm;
use App\Http\Requests\Template;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TemplateFormController extends Controller
{
    public function index()
    {
        $templates = TemplateForm::orderby('active', 'desc')->paginate('20');

        return view('pages.templateform.index', compact('templates'));
    }

    public function getform(Request $req)
    {
        $templates = TemplateForm::where('active', true)->first();

        // enum('pre_filter','bop_session','pru_dna_test','pmli_filter','training','certification','onboard','active','lead','waiting_payment')
        $applicant = Applicant::where('uuid', $req->id)
          ->where('current_status', 'pre_filter')
          ->whereIn('status_id', [1, 7])
          ->first();
        $term_condition = Setting::where('meta_key', "document_tnc_{$req->lang}")->first()->meta_value;

        if (isset($applicant)) {
            return [
                'template' => $templates,
                'applicant' => $applicant,
                'term_condition' => $term_condition,
            ];
        }

        return response('[]', 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
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
     * @param Template $request
     * @return RedirectResponse
     */
    public function store(Template $request)
    {
        $data = $request->all();

        if (!isset($data['additional_info'])) {
            $data['additional_info'] = [];
        }

        TemplateForm::create($data);

        return redirect('templateforms');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\TemplateForm $templateForm
     *
     * @return Response
     */
    public function edit($templateForm)
    {
        $templateForm = TemplateForm::findOrFail($templateForm);

        return view('pages.templateform.edit', compact('templateForm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Template $request
     * @param mixed $id
     *
     * @return RedirectResponse
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

        if (!isset($validated_data['additional_info'])) {
            $template_detail->additional_info = [];
        } else {
            $template_detail->additional_info = $validated_data['additional_info'];
        }

        $template_detail->active = $active;
        $template_detail->save();

        return  redirect('templateforms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $req
     * @return Response
     * @throws \Exception
     */
    public function destroy(Request $req)
    {
        $temp = TemplateForm::findorfail($req->id);
        $temp->delete();

        return redirect('templateforms');
    }

    /**
     * Display a listing of City resource.
     *
     * @return Collection
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
      ->get();
        // $townships = $townships->map(function ($township) {
    //     return [
    //         'city_id' => $township->city_id,
    //         'township_id' => $township->id,
    //         'township_description' => $township->description[0]->description_name,
    //     ];
    // });
    }
}
