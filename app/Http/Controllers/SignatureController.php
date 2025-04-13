<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Offices;
use App\Models\Signatories;

class SignatureController extends Controller
{
    public function signRead()
    {
        $office = Offices::whereIn('id', [11, 18, 20, 21, 22, 37, 91, 39])
                 ->orderBy('office_name', 'asc')
                 ->get();

        $signatories = Signatories::all();

        return view('signature.listsign', compact('office', 'signatories'));
    }

    public function getsignatoryRead() 
    {
        $data = Signatories::orderBy('id', 'ASC')->get();

        return response()->json(['data' => $data]);
    }

    public function signCreate(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'fname' => 'required',
                'mname' => 'required',
                'lname' => 'required',
                'role' => 'required',
            ]);

            try {
                Signatories::Create([
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'lname' => $request->input('lname'),
                    'role' => $request->input('role'),
                    'rank' => $request->input('rank'),                                                                                  
                    'dept' => $request->input('dept'),
                    'deptID' => $request->input('deptID'),
                    'campus' => $request->input('campus'),
                    'remember_token' => Str::random(60),             
                ]);    
                return response()->json(['success' => true, 'message' => 'Signatory Saved Successfully'], 200);         
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to Save Signatory'], 404);
            }
        }
    }

    public function signatureUpdate(Request $request) 
    {
        $request->validate([
            'fname' => 'required',
            'mname' => 'required',
            'lname' => 'required',
            'role' => 'required',
        ]);

        try {
            $lName = $request->input('lname'); 
            $fName = $request->input('fname'); 
            $mName = $request->input('mname'); 

            $existingSign = Signatories::where('lname', $lName)
                        ->where('fname', $fName)
                        ->where('mname', $mName)
                        ->where('id', '!=', $request->input('id'))
                        ->first();

            if ($existingSign) {
                return response()->json(['error' => true, 'message' => 'Signatory already exists'], 404);
            }

            $sig = Signatories::findOrFail($request->input('id'));
            $sig->update([
                'fname' => $request->input('fname'),
                'mname' => $request->input('mname'),
                'lname' => $request->input('lname'),
                'role' => $request->input('role'),
                'rank' => $request->input('rank'),   
                'campus' => $request->input('campus'),
        ]);
            return response()->json(['success' => true, 'message' => 'Signatory update successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to Update Signatory'], 404);
        }
    }

    public function signatureDelete($id) 
    {
        $sig = Signatories::find($id);
        $sig->delete();

        return response()->json(['success'=> true, 'message'=>'Deleted Successfully',]);
    }
}
