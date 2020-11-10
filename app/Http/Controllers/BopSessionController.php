<?php

namespace App\Http\Controllers;

use App\BopSession;
use App\Http\Requests\BopSessionRequest;
use App\Http\Resources\BopSessionResource;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class BopSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = BopSession::latest()->paginate(15);

        return view('pages.b_o_p_sessions.index', compact('sessions'));
    }

    public function getAllSessions(Request $request)
    {
        $keyword = $request->q;
        $applicant_id = $request->applicant_id;

        $bop_sessions = BopSession::enable()->when($keyword, function ($query, $keyword) {
            return $query->where('title', 'like', "%{$keyword}%");
        })->when($applicant_id, function ($query, $applicant_id) {
            return $query->whereDoesntHave('applicants', function (Builder $query) use ($applicant_id) {
                $query->where('applicant_id', $applicant_id);
            });
        })->get();

        return response()->json([
            'status' => true,
            'sessions' => BopSessionResource::collection($bop_sessions),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.b_o_p_sessions.create');
    }

    /*
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
     * @return Redirector
     * @throws Exception
     */
    public function update(BopSessionRequest $request, BopSession $session)
    {
        $data = $request->validated();

        $session->title = $data['title'];
        $session->session = Carbon::parse("{$data['date']} {$data['time']}");
        $session->url = $data['url'];
        $session->enable = $data['enable'];
        $session->save();

        return redirect('/sessions')->with('message', 'Updated Successfully');
    }

    /*
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
