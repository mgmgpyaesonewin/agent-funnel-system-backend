<?php

namespace App\Http\Controllers;

use DB;
use App\Applicant;
use App\Http\Requests\TrainingRequest;
use App\Http\Resources\TrainingResource;
use App\Training;
use Illuminate\Http\Request;

use App\Exports\TrainingExport;
use Maatwebsite\Excel\Facades\Excel;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::with('applicants')->paginate(20);
        $total_trainee = DB::table('applicant_status')->where('current_status', 'pmli_filter')->where('status_id','3')->count();  

        return view('pages.training.index', compact('trainings', 'total_trainee'));
    }

    public function export($id)
    {
        $completed = Training::with(array('applicants'=>function($query){
            $query->select('name','phone');
        }))->find($id);
        
        $training = $completed->name;
        $assigned = DB::table('applicants')    
                    ->select('name', 'phone')                
                    ->leftjoin('applicant_training', 'applicant_training.applicant_id', '=', 'applicants.id')
                    ->where('applicants.current_status', 'training')
                    ->whereRaw('(applicant_training.applicant_id IS NULL OR applicant_training.training_id != '.$id.')')
                    ->get();
                    //dd($completed->applicants);
        // TODO: export excel
        return Excel::download(new TrainingExport($completed->applicants, $assigned, $training), 'ApplicantTrainingDetails.xlsx');
    }

    public function getAllTrainings(Request $request)
    {
        $trainings = Training::where('enable', '1')->get();

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
        $check = DB::table('applicant_training')->where('training_id', $training->id)->count();
        
        if($check == 0)
        {
            $training->delete();
            return redirect('/trainings')->with('status', 'Successfully deleted a training course');
        }    
        else
        {
            return redirect('/trainings')->withErrors(['You cannot delete this training course because it is assigned to applicants.']);
        }
    }
}
