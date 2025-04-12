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
                return redirect()->route('signRead')->with('success', 'Signatory Saved Successfully');             
            } catch (\Exception $e) {
                return redirect()->route('signRead')->with('error', 'Failed to Save Signatory');
            }
        }
    }
}
