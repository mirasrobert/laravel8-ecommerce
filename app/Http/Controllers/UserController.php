<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() {

        
    }

    public function edit() {
        return view('user.profile.edit-profile');
    }

    public function update(User $user, UserRequest $request){

        if(!$user->realUser($user->id)) {
            return back();
        }

        if(Hash::check($request->password, $user->password)) {
            $user->update($request->only(['name', 'email']));
        } else {
            return back()->with('error', 'Invalid password.');
        }

        return redirect()->route('orders.index')->with('status', 'User profile has been updated.');

    }

    public function changePassword() 
    {
        return view('user.profile.change-password');
    }

    public function change(User $user, Request $request) {

        if(!$user->realUser($user->id)) {
            return back();
        }

        // Simple validation
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ]);

        // Check old password
        if(Hash::check($request->old_password, $user->password)) {
            // Update password
            $user->update([
                'password' => Hash::make($request->password)
            ]);

        } else {
            return back()->with('error', 'Invalid password.');
        }

        return redirect()->route('orders.index')->with('status', 'Password has been updated.');
    }
}
