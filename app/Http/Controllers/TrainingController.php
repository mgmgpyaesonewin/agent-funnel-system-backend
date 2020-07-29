<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingRequest;
use App\Training;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::all();

        return view('pages.training.index', compact('trainings'));
    }

    public function create()
    {
        return view('pages.training.create');
    }

    public function store(TrainingRequest $request)
    {
        Training::create($request->validated());

        return view('pages.training.index');
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
