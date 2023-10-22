<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        abort_if(!auth()->user()->isOwner(), 403);

        $users = User::where('company_id', auth()->user()->company->id)->paginate(10);

        return view('users.index', [
            'users' => $users
        ]); 
    }

    public function create()
    {
        abort_if(!auth()->user()->isOwner(), 403);

        return view('users.create');
    }

    public function store(Request $request)
    {
        abort_if(!auth()->user()->isOwner(), 403);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],//users(name table)
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'company_id' => auth()->user()->company->id,
        ]);

        return redirect()->route('users.index');
    }
    
    public function destroy(User $user)
    {
        abort_if(auth()->user()->company->id !== $user->company_id, 404);

        abort_if(!auth()->user()->isOwner(), 403);

        $user->delete();

        return redirect()->route('users.index');
    }
}
