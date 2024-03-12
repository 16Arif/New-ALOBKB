<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateImageProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function edit($id)
    {
        $user = Auth::user();
        return view('pages.profile.upload_image', compact('user'));
    }

    public function update(UpdateImageProfileRequest $request, User $user)
    {
        $data = $request->validated();
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('profile-image');
        }
        $user = auth()->user();
        $user->update($data);
        return redirect()->route('home.index')->with('success', 'Profil Berhasil Diperbarui');
    }
}
