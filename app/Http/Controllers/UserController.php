<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Offices;

class UserController extends Controller
{
    public function userRead()
    {
        $user = User::all();
        $office = Offices::orderBy('office_name', 'asc')->get();

        return view('users.list_user', compact('user', 'office'));
    }

    public function userCreate(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'fname' => 'required',
                'mname' => 'required',
                'lname' => 'required',
                'email' => 'required',
                'password' => 'required',
                'role' => 'required',
            ]);

            try {
                User::Create([
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'lname' => $request->input('lname'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')), 
                    'role' => $request->input('role'),
                    'dept' => $request->input('dept'),
                    'campus' => $request->input('campus'),
                    'remember_token' => Str::random(60),             
                ]);      
                return redirect()->route('userRead')->with('success', 'User Saved Successfully');             
            } catch (\Exception $e) {
                return redirect()->route('userRead')->with('error', 'Failed to Save User');
            }
        }
    }

    // Edit user
    public function edit($id)
    {
        $user = User::findOrFail($id); // Find user by ID
        return view('users.edit', compact('user')); // Pass user data to view
    }

    // Update user
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'role' => 'required|in:User,Administrator',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update user details
        $user->update([
            'fname' => $request->input('fname'),
            'mname' => $request->input('mname'),
            'lname' => $request->input('lname'),
            'role' => $request->input('role'),
        ]);

        // Redirect back with success message
        return redirect()->route('userRead')->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id); // Find the user by ID
            $user->delete(); // Delete the user

            return redirect()->route('userRead')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('userRead')->with('error', 'Failed to delete user.');
        }
    }
}