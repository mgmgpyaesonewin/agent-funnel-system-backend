<?php

namespace App\Http\Controllers;

use App\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function applicants(Request $request)
    {
        $applicants = Applicant::where('status_id', $request->status)->paginate(10);

        return view('pages.applicants.pending', compact('applicants'));
    }

    public function applicantsDetail(Request $request)
    {
        $applicant = Applicant::where('id', $request->id)->first();

        return view('pages.applicants.detail', compact('applicant'));
    }
}
