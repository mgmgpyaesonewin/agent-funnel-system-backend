<?php

namespace App\Http\Controllers;

use App\BopSession;
use App\Http\Requests\BopSessionRequest;
use Carbon\Carbon;
use DB;
use Exception;

class BopSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = BopSession::latest()->paginate(15);

        return view('pages.b_o_p_sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.b_o_p_sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BopSessionRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $session = new BopSession();
            $session->title = $data['title'];
            $session->session = Carbon::parse("{$data['date']} {$data['time']}");
            $session->url = $data['url'];
            $session->save();
            DB::commit();

            return redirect('/sessions')->with('message', 'Created Successfully');
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(BopSession $bOPSession)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(BopSession $session)
    {
        return view('pages.b_o_p_sessions.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(BopSessionRequest $request, BopSession $session)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $session->title = $data['title'];
            $session->session = Carbon::parse("{$data['date']} {$data['time']}");
            $session->url = $data['url'];
            $session->save();
            DB::commit();

            return redirect('/sessions')->with('message', 'Updated Successfully');
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(BopSession $session)
    {
        DB::beginTransaction();

        try {
            $session->delete();
            DB::commit();

            return redirect('/sessions')->with('message', 'Deleted Successfully');
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
