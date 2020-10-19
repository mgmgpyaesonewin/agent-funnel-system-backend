<?php

namespace App\Http\Controllers;

use App\BOPSession;
use App\Http\Requests\BOPSessionRequest;
use Carbon\Carbon;
use DB;
use Exception;

class BOPSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = BOPSession::latest()->paginate(15);

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
    public function store(BOPSessionRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $session = new BOPSession();
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
    public function show(BOPSession $bOPSession)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(BOPSession $session)
    {
        return view('pages.b_o_p_sessions.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(BOPSessionRequest $request, BOPSession $session)
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
    public function destroy(BOPSession $session)
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
