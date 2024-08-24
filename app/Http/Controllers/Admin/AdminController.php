<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function edit()
    {
        $admin = Auth::guard('admin')->user();

        return Inertia::render('Admin/Setting', [
            'admin' => $admin,
        ]);
    }

    public function update(AdminUpdateRequest $request)
    {
        $admin = Auth::guard('admin')->user();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }
        $admin->save();
        // session()->flash('success', 'Profile updated successfully.');
        return redirect()->route('admin.setting')->with('success', 'Profile updated successfully.');
    }
}
