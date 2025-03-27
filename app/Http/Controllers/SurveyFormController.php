<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

use App\Models\TrainingTitle;
use App\Models\TrainingQuestion;
use App\Models\FormSurvey;
use App\Models\DefaultQuestion;

class SurveyFormController extends Controller
{
    public function surveyformRead($id)
    {
        $formlinks = TrainingTitle::find($id);
        // $formlinksquestions = TrainingTitle::join('training_question', 'training_title.id', '=', 'training_question.title_id')
        //     ->where('title_id', $id)
        //     ->get();
        $formlinksquestions = TrainingTitle::join('training_question', 'training_title.id', '=', 'training_question.title_id')
                ->where('training_title.id', $id)
                ->select('training_title.*', 'training_question.*')
                ->get();
        
        return view('surveyquestion.form_survey', compact('formlinks', 'formlinksquestions'));
    }

    public function submitted_surveyformRead()
    {
        return view('surveyquestion.formsurvey_submit');
    }

    public function surveyformCreate(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'title_id' => 'required',
                'name' => 'required',
                'office' => 'required',
                'contact_information' => 'required',
                'question' => 'required|array',
                'question_rate' => 'required|array',
                'feedback' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (str_word_count($value) > 50) {
                            $fail("The $attribute must not be more than 50 words.");
                        }
                    }
                ],
                'feedback2' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (str_word_count($value) > 50) {
                            $fail("The $attribute must not be more than 50 words.");
                        }
                    }
                ],
            ]);
            
            try {
                $existingSurvey = FormSurvey::where([
                    ['title_id', '=', $request->input('title_id')],
                    ['name', '=', $request->input('name')],
                    ['office', '=', $request->input('office')],
                    ['contact_information', '=', $request->input('contact_information')],
                ])->first();

                if ($existingSurvey) {
                    return redirect()->route('formRead')->with('error', 'Duplicate entry detected');
                }

                FormSurvey::create([
                    'title_id' => $request->input('title_id'),
                    'name' => $request->input('name'),
                    'office' => $request->input('office'),
                    'contact_information' => $request->input('contact_information'),
                    'question' => json_encode($request->input('question')),
                    'question_rate' => json_encode($request->input('question_rate')),
                    'feedback' => $request->input('feedback'),
                    'feedback2' => $request->input('feedback2'),
                    'remember_token' => Str::random(60),
                ]);

                return redirect()->route('submitted_surveyformRead')->with('success', 'Survey Submitted Successfully');
            } catch (\Exception $e) {
                return redirect()->route('formRead')->with('error', 'Failed to Submit Survey');
            }
        }
    }
}
