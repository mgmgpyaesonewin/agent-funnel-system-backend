<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Http\Requests\TrainingRequest;
use App\Http\Resources\TrainingResource;
use App\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::all();

        return view('pages.training.index', compact('trainings'));
    }

    public function getAllTrainings(Request $request)
    {
        $trainings = Training::all();

        return response()->json([
            'data' => TrainingResource::collection($trainings),
            'completed' => Applicant::find($request->applicant_id)->trainings()->pluck('trainings.id'),
        ]);
    }

    public function create()
    {
        return view('pages.training.create');
    }

    public function store(TrainingRequest $request)
    {
        Training::create($request->validated());

        return redirect('/trainings');
    }

    public function show(Training $training)
    {
    }

    public function edit(Training $training)
    {
        return view('pages.training.edit', compact('training'));
    }

    public function update(TrainingRequest $request, Training $training)
    {
        $training->update(
            $request->validated()
        );

        return redirect('/trainings');
    }

    public function destroy(Training $training)
    {
        $training->delete();

        return redirect('/trainings');
    }
}
