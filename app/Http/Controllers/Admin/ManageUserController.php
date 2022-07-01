<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use PDF;

class ManageUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role_id');
        if (request('search')) {
            $users->where('name', 'like', '%'.request('search').'%')
                ->orWhere('email', 'like', '%'.request('search').'%')
                ->orWhereHas('role', function ($query) {
                    $query->where('name', 'like', '%'.request('search').'%');
                });
        }
        $users = $users->paginate(10)->withQueryString();

        return view('admin.ManageUser.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.ManageUser.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users',
            'role_id' => 'required|in:1,2,3,4',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        User::create($user);

        return redirect()->route('admin.user.index')->with('status', 'Pengguna Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.ManageUser.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => "required|email|unique:users,email,{$id}",
            'role_id' => 'required|in:1,2,3,4',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        ! $request->has('reset-password') ?: $user->password = Hash::make('12345678');
        $user->save();

        return redirect()->route('admin.user.index')->with('status', 'Data Pengguna Berhasil Diubah!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('delete', 'Pengguna Berhasil Dihapus!');
    }

    public function printAllUsers()
    {
        // retreive all records from db
        $users = User::orderBy('role_id')->get();
        $pdf = PDF::loadView('admin.ManageUser.printAllUsers', compact('users'));
        // download PDF file with download method
        return $pdf->stream();
    }
}
