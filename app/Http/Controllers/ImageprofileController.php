<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateImageProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageprofileController extends Controller
{
    public function edit($id)
    {
        $user = Auth::user();
        return view('pages.profile.upload_image', compact('user'));
    }

    public function update(UpdateImageProfileRequest $request, $id)
    {
        $data = $request->validated();
        if ($request->file('image')) {
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $data['image'] = $request->file('image')->store('profile-images');
        }
        User::whereId($id)->update($data);
        return redirect()->route('home.index')->with('success', 'Profil Berhasil Diperbarui');
    }

    public function destroy(User $user, $id){
        // Find the user by ID
        $foundUser = User::find($id);

        if ($foundUser) {
            if ($foundUser->image) {
                // Delete the image
                Storage::delete($foundUser->image);

                // Update the image attribute
                $foundUser->image = null;
                $foundUser->save();
            } else {
                // No image found
                return redirect()->route('home.index')->with('info', 'Anda tidak memiliki foto profile');
            }
        } else {
            // User not found
            return redirect()->route('home.index')->with('error', 'User not found');
        }

        return redirect()->route('home.index')->with('success', 'Foto Profil Berhasil Dihapus');
    }
}
