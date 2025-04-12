<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

use App\Models\TrainingTitle;
use App\Models\TrainingQuestion;
use App\Models\FormSurvey;
use App\Models\DefaultQuestion;

class ReportController extends Controller
{
    public function reportRead()
    {
        $reports = TrainingTitle::where('postedBy', Auth::guard('web')->user()->id)->get();
        return view('reports.list_reports', compact('reports'));
    }

    public function reportViewSurvey($id)
    {
        $trainingID = decrypt($id);
        $reportformtitleID = TrainingTitle::find($trainingID);

        $reportformtitle = FormSurvey::join('training_title', 'form_survey.title_id', '=', 'training_title.id')
                        ->where('form_survey.title_id', $trainingID)
                        ->select('form_survey.*', 'training_title.*', 'form_survey.id as fsid', 'form_survey.office as fsoff')
                        ->get();
                        
        $getTitleID =TrainingQuestion::where('title_id', $trainingID)->get();

        return view('reports.listreports_view', compact('reportformtitleID', 'reportformtitle', 'getTitleID'));
    }

    public function PDFreportViewSurveyresult($id) 
    {
        $pdfreportformtitleID = TrainingTitle::find($id);
        $getRate = FormSurvey::where('title_id', $id)->get();
        $getQuestion = TrainingQuestion::where('title_id', $id)->get();
        
        $pdfreportformtitlequestion = FormSurvey::join('training_question', 'form_survey.title_id', '=', 'training_question.title_id')
                        ->where('form_survey.title_id', $id)
                        ->select('training_question.*', 'training_question.id as tid',  'form_survey.*')
                        ->first();

        $pdfreportformtitlequestionrate = FormSurvey::join('training_question', 'form_survey.title_id', '=', 'training_question.title_id')
                        ->where('form_survey.title_id', $id)
                        ->select('training_question.*', 'training_question.id as tid',  'form_survey.*')
                        ->get();

        $reportformtitle = FormSurvey::join('training_title', 'form_survey.title_id', '=', 'training_title.id')
                        ->where('form_survey.title_id', $id)
                        ->get();

        $data=[
            'pdfreportformtitleID' => $pdfreportformtitleID,
            'pdfreportformtitlequestion' => $pdfreportformtitlequestion,
            'pdfreportformtitlequestionrate' => $pdfreportformtitlequestionrate, 
            'reportformtitle' => $reportformtitle, 
            'getRate' => $getRate, 
            'getQuestion' => $getQuestion, 
        ];

        $pdf = PDF::loadView('reports.listreports_viewpdf', $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function PDFSurveyRatedTemplate($id) 
    {
        $trainingID = FormSurvey::find($id);

        $surveyRatings = FormSurvey::join('training_title', 'form_survey.title_id', '=', 'training_title.id')
                        ->where('form_survey.id', $id)
                        ->select('form_survey.*', 'training_title.*', 'form_survey.office as fsoff')
                        ->get();

        $formtitle = TrainingTitle::join('training_question', 'training_title.id', '=', 'training_question.title_id')
                    ->where('training_title.id', $surveyRatings->first()->title_id)
                    ->select('training_title.*', 'training_question.*')
                    ->get();

        $data = [
            'formtitle' => $formtitle, 
            'surveyRatings' => $surveyRatings
        ];

        $pdf = PDF::loadView('reports.surveyratedform', $data)->setPaper('[0, 0, 612, 792]', 'portrait');
        return $pdf->stream();
    }

}

