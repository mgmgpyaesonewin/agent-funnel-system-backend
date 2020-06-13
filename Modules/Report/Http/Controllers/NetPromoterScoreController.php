<?php

namespace Modules\Report\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Report\Entities\NetPromoterScore;
use Modules\Report\Entities\Option;

class NetPromoterScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $option_id = $request->option ?? null;
        $from = $request->from ?? null;
        $to = $request->to ?? null;

        $scores = NetPromoterScore::when($option_id, function ($query) use ($option_id) {
            return $query->where('option_id', $option_id);
        })->when($from, function ($query) use ($from, $to) {
            return $query->whereBetween('created_at', [$from, $to]);
        })->groupBy('score')->selectRaw('count(*) as count, score')->get();

        $total = NetPromoterScore::when($option_id, function ($query, $option_id) {
            return $query->where('option_id', $option_id);
        })->when($from, function ($query) use ($from, $to) {
            return $query->whereBetween('created_at', [$from, $to]);
        })->count();

        $no_of_promoter = NetPromoterScore::where([['score', '>', '6'], ['score', '<', '9']])
            ->when($option_id, function ($query, $option_id) {
                return $query->where('option_id', $option_id);
            })->when($from, function ($query) use ($from, $to) {
                return $query->whereBetween('created_at', [$from, $to]);
            })->count();

        $no_of_detractor = NetPromoterScore::when($option_id, function ($query, $option_id) {
            return $query->where('option_id', $option_id);
        })->when($from, function ($query) use ($from, $to) {
            return $query->whereBetween('created_at', [$from, $to]);
        })->where([['score', '<', '7']])->count();

        $nps = $no_of_promoter - $no_of_detractor;

        $options = Option::all();

        return view('report::nps.index', compact('nps', 'scores', 'total', 'options'));
    }

    public function score(Request $request)
    {
        $score = $request->score;
        $scores = NetPromoterScore::where('score', $score)->paginate(10);

        return view('report::nps.score', compact('scores'));
    }

    public function getScoreHistory(Request $request)
    {
        $user_id = $request->id;
        $history = User::with('scores.option')->where('id', $user_id)->first();

        return view('report::nps.history', compact('history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('report::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return view('report::show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        return view('report::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
    }
}
