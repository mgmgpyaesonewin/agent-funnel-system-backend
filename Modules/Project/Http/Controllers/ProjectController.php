<?php

namespace Modules\Project\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

//MODELS
use Modules\Core\Models\Category;
use Modules\Core\Models\PromoCode;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('project::promo_code');
    }

    public function promo(Request $request)
    {
        $code = $request->code;
        $status = $request->status;
        $type = $request->type;
        $fromDate = $request->from;
        $toDate = $request->to; 
        $service = $request->service; 
        $category = $request->category; 

        // $codes = PromoCode::whereNotNull('promo_codes.code')
        //                     ->leftJoin('categories', 'promo_codes.category_id', '=', 'categories.id');
                            // ->leftJoin('projects', 'projects.code', '=', 'promo_codes.id')
                            // ->selectRaw('promo_codes.*, categories.name, count(projects.code) as total_used');         
            $codes = PromoCode::with('project')
                                ->leftJoin('categories', 'promo_codes.category_id', '=', 'categories.id')
                                ->selectRaw('promo_codes.*, categories.name');                 
        

        if (!empty($code)) {
            $codes->where('promo_codes.code', 'LIKE', '%'.$code.'%');
        }

        if (!empty($status)) { 
            $codes->where('promo_codes.status', $status);
        }

        if (!empty($type)) { 
            $codes->where('type', $type);
        }

        if (!empty($service)) { 
            $codes->where('service_type_id', $service);
        }

        if (!empty($category)) { 
            $codes->where('category_id', $category);
        }
        
        if ( $request->has('from') || $request->has('to')) { 
            if( (!empty($fromDate) && empty($toDate)) ||   (!empty($toDate) && empty($fromDate)))
            {
                return redirect()->back()
                        ->withErrors(['Please choose both from date and to date.'])
                        ->withInput($request->input());
            }
            else if(!empty($fromDate) && !empty($toDate))
            {
                $codes->whereBetween('promo_codes.created_at', [$fromDate, $toDate]);
            }            
        }
        

        $codes = $codes->orderBy('promo_codes.id', 'desc')->paginate(2);//->groupBy('projects.code')->get();
        $categories = Category:://whereNull('parent_id')
                        orderBy('name')
                        ->get();
        return view('project::promo_list', compact('categories', 'codes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function promo_create()
    {
        $categories = Category:://whereNull('parent_id')
                orderBy('name')
               ->get();

        return view('project::promo_create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function promo_store(Request $request)
    {
        $validatedData = [
            'code' => 'required|unique:promo_codes,code',
            'from' => 'required|date',
            'to' => 'required|date',
            'value' => 'required'
        ];
        $request->validate($validatedData);

        if (isset($request->validator) && $request->validator->fails()) {
            return redirect('/project/promo/create')
                        ->withErrors($validatedData)
                        ->withInput($request->input());
        }

        $promo = new PromoCode;

        $promo->code = $request->code;
        $promo->from = $request->from;
        $promo->to = $request->to;
        $promo->type = $request->type;
        $promo->value = $request->value;
        $promo->remark = $request->remark;
        $promo->category_id = $request->category;
        $promo->service_type_id = $request->service_type;

        $promo->save();

        return redirect('/project/promo')->with('status', 'Success fully added new record.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('project::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('project::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function promo_pause(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function promo_destroy($id)
    {
        //
    }
}
