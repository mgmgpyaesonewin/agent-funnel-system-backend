<?php

namespace App\Http\Controllers;

use App\Http\Requests\Template;
use App\TemplateForm;
use Illuminate\Http\Request;

class TemplateFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = TemplateForm::all();
        return view('pages.templateform.index', compact('templates'));
    }

    public function getform()
    {
        $templates = TemplateForm::where('active', true)->first();
        return $templates;
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
     * @param  \Illuminate\Http\Request  $request
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
     * @param  \App\TemplateForm  $templateForm
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TemplateForm  $templateForm
     * @return \Illuminate\Http\Response
     */
    public function update(Template $request, $id)
    {
        $validated_data = $request->validated();
        $Templatedetail =  TemplateForm::findOrFail($id);
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
     * @param  \App\TemplateForm  $templateForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        //
        $temp = TemplateForm::findorfail($req->id);
        $temp->delete();
        return redirect('templateforms');
    }
}
