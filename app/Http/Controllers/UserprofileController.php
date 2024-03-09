<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserprofileController extends Controller
{
    public function edit($id)
    {
        // $user = User::findOrFail($id);
        $user = Auth::user();
        return view('pages.users.edit_profile', compact('user'));
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
        $data = $request->validated();
        $user = auth()->user();
        $user->update($data);
        return redirect()->route('home.index')->with('success', 'Profil Berhasil Diperbarui');
    }
}
