<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function get_view_change_password(Request $request)
    {
        return view('admin.user.change_password');
    }

    public function change_password(Request $request, $user_id)
    {
        $request->validate([
            'new_password' => 'required|string|min:8',
        ]);

        $id = Auth::id();
        if ($id == $user_id) {
            User::where('id', $user_id)->update([
                'password' => Hash::make($request->new_password),
            ]);
        }
        return redirect()->back()->with('success', 'Sửa Thành Công.');
    }
}
