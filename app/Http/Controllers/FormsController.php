<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use PDF;

use App\Models\TrainingTitle;
use App\Models\TrainingQuestion;
use App\Models\DefaultQuestion;

class FormsController extends Controller
{
    public function formRead()
    {
        $form = TrainingTitle::where('postedBy', Auth::guard('web')->user()->id)->get();
        return view('forms.list_forms', compact('form'));
    }

    public function formCreate(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required',
                'speaker' => 'required',
                'training_month' => 'required',
                'surveylink' => 'nullable|url',
                
            ]);

            try{
                $training_days = implode(', ' , $request->input('training_day'));
                $addtitle = TrainingTitle::create([
                    'title' => $request->input('title'),
                    'office' => Auth::guard('web')->user()->dept,
                    'speaker' => $request->input('speaker'),
                    'training_month' => $request->input('training_month'),
                    'training_day' => $training_days,
                    'training_year' => $request->input('training_year'),
                    'training_venue' => $request->input('training_venue'), 
                    'postedBy' => Auth::guard('web')->user()->id, 
                    'remember_token' => Str::random(60),             
                ]); 

                $base_url = url('/survey');
                $unique_link = $base_url . '/' . $addtitle->id . '/' . Str::random(60);
                $addtitle->update([
                    'surveylink' => $unique_link,
                ]);     

                $defaultQuestions = DefaultQuestion::all();  // Fetch all DefaultQuestion entries
                foreach ($defaultQuestions as $question) {
                    TrainingQuestion::create([
                        'title_id' => $addtitle->id,
                        'question' => $question->defquestion, 
                        'remember_token' => Str::random(60),
                    ]);
                }
                
                return redirect()->route('formQuestion', encrypt($addtitle->id ))->with('success', 'Form Created Successfully');             
            }catch(\Exception $e) {
                return redirect()->route('formRead')->with('error', 'Failed to Save Form');
            }
        }
    }

    public function formQuestion($id)
    {
        $trainingID = decrypt($id);
        $formtitleID = TrainingTitle::find($trainingID);
        
        $formtitle = TrainingTitle::join('training_question', 'training_title.id', '=', 'training_question.title_id')
                    ->where('training_title.id', $trainingID)
                    ->select('training_title.*', 'training_question.*')
                    ->get();

        return view('forms.listview_forms', compact('formtitleID', 'formtitle'));
    }

    public function formquestionCreate(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'title_id' => 'required',
                'question' => 'required',
            ]);

            try{
                TrainingQuestion::create([
                    'title_id' => $request->input('title_id'),
                    'question' => $request->input('question'), 
                    'remember_token' => Str::random(60),             
                ]);      
                return redirect()->back()->with('success', 'Question Created Successfully');             
            }catch(\Exception $e) {
                return redirect()->route('formRead')->with('error', 'Failed to Save Question');
            }
        }
    }

    public function updateQuestion(Request $request, $id)
    {
        $question = TrainingQuestion::find($id);
        if ($question) {
            $question->question = $request->input('question');
            $question->save();
            return response()->json(['message' => 'Question updated successfully!']);
        }
        return response()->json(['message' => 'Question not found!'], 404);
    }


    public function PDFSurveyShowTemplate($id) {
        $trainingID = decrypt($id);
        $formtitleID = TrainingTitle::find($trainingID);
        
        $formtitle = TrainingTitle::join('training_question', 'training_title.id', '=', 'training_question.title_id')
                    ->where('training_title.id', $trainingID)
                    ->select('training_title.*', 'training_question.*')
                    ->get();
        $data=[
            'formtitleID' => $formtitleID,
            'formtitle' => $formtitle, 
        ];

        $pdf = PDF::loadView('forms.pdf.surveyform', $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

     public function formDelete($id)
    {
        try {
            $form = TrainingTitle::findOrFail($id);
            $form->delete();
            return redirect()->route('formRead')->with('success', 'Form Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->route('formRead')->with('error', 'Failed to Delete Form');
            }
        }

    public function deleteQuestion($id)
    {
        try {
            $question = TrainingQuestion::findOrFail($id);
            $question->delete();
            return redirect()->back()->with('success', 'Question Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to Delete Question');
        }
    }
}
