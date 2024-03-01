<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserprofileController extends Controller
{
    public function edit($id){
        $user = User::findOrFail($id);
        return view('pages.users.edit_profile', compact('user'),  ['type_menu' => '']);
    }
}
