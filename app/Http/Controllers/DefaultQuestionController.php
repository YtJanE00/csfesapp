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

use App\Models\DefaultQuestion;

class DefaultQuestionController extends Controller
{
    public function defquestionStore()
    {
        $defquest = DefaultQuestion::orderBy('id', 'ASC')->get();

        return view('question.listquest', compact('defquest'));
    }

    public function defquestionCreate(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'defquestion' => 'required',
            ]);

            try{

                $addquest = DefaultQuestion::create([
                    'defquestion' => $request->input('defquestion'),           
                ]);     
                
                return redirect()->route('defquestionStore')->with('success', 'Question Created Successfully');             
            }catch(\Exception $e) {
                return redirect()->route('defquestionStore')->with('error', 'Failed to Save Question');
            }
        }
    }
}
