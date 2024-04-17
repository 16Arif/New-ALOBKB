<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $users = DB::table('users')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.users.index', compact('users'),  ['type_menu' => '']);
    }

    public function create()
    {
        return view('pages.users.create',  ['type_menu' => '']);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        // Jika roles adalah ADMIN, atur is_admin menjadi 1
        if ($request->roles == 'ADMIN') {
            $data['is_admin'] = 1;
        } else {
            $data['is_admin'] = 0;
        }
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect()->route('user.index')->with('success', 'User Successfully Created');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.edit', compact('user'),  ['type_menu' => '']);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        // Jika roles adalah ADMIN, atur is_admin menjadi 1
        if ($request->roles == 'ADMIN') {
            $data['is_admin'] = 1;
        } else {
            $data['is_admin'] = 0;
        }
        $user->update($data);
        return redirect()->route('user.index')->with('success', 'User Successfully Updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User Successfully Deleted');
    }
}
