<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function profile(User $user)
    {
        $user = $user->load('department', 'position');

        return view('admin.users.profile', compact('user'));
    }

    public function profileUpload(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if ($request->file('profile_image')) {
            $old_file = auth()->user()->photo;
            if ($old_file) {
                Storage::disk('public')->delete('profiles/' . $old_file);
            }
            $fileName = uniqid() . $request->file('profile_image')->getClientOriginalName();
            $request->file('profile_image')->storeAs('public/profiles', $fileName);

            auth()->user()->update(['photo' => $fileName]);

            return 'success';
        }

        return 'fail';
    }

    public function passwordChange(Request $request)
    {
        $new_pw = $request->new_pw;

        if (strlen($new_pw) < 6 || !$new_pw) {
            return 'fail';
        }

        auth()->user()->update([
            'password' => bcrypt($new_pw),
            'pw_changed_date' => now(),
        ]);

        return 'success';
    }

}
