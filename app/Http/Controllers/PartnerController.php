<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartnerRequest;
use App\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $company = $request->company;
    
        $partners = Partner::with('users');

        if(!empty($name)) {            
            $partners->where('pic_name', 'like', '%'.$name.'%');
        }

        if(!empty($company)) { 
            $partners->where('company_name', 'like', '%'.$company.'%');
        }
        
        $partners = $partners->orderBy('id', 'desc')->paginate(20);

        return view('pages.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('pages.partners.create');
    }

    public function store(PartnerRequest $request)
    {
        Partner::create($request->validated());

        return redirect('/partners');
    }

    public function show(Partner $partner)
    {
    }

    public function edit(Partner $partner)
    {
        return view('pages.partners.edit', compact('partner'));
    }

    public function update(PartnerRequest $request, Partner $partner)
    {
        $partner->update($request->validated());

        return redirect('/partners');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect('/partners');
    }
}
