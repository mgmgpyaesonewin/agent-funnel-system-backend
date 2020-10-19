<?php

namespace App\Http\Controllers;

use App\BOPSession;
use App\Http\Requests\BOPSessionRequest;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;

class BOPSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = BOPSession::paginate(15);

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
    public function edit(BOPSession $bOPSession)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BOPSession $bOPSession)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(BOPSession $bOPSession)
    {
    }
}
