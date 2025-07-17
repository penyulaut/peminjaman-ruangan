<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'title' => 'User',
            'roles' => Role::all(),
            'users' => User::latest()->paginate(10),
            'adminCount' => User::where('role_id', 1)->count(),
            'dosenCount' => User::where('role_id', 2)->count(),
            'mahasiswaCount' => User::where('role_id', 3)->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'nim' => 'required|min:7|max:18|unique:users,nim',
            'email' => 'required|email:dns',
            'jurusan' => 'required|max:255',
            'no_hp' => 'required|max:15', 
            'password' => 'required|min:4',
            'role_id' => 'required'
        ]);
        
        

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect('/dashboard/users')->with('userSuccess', 'Data user berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return json_encode($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    
    $rules = [
        'name' => 'required|max:100',
        'jurusan' => 'required|string|max:255',
        'role_id' => 'required',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
    ];

    if ($request->nim != $user->nim) {
        $rules['nim'] = 'required|min:7|max:18|unique:users,nim,'.$user->id;
    }

    $validatedData = $request->validate($rules);

    $user->update($validatedData);

    return redirect('/dashboard/users')->with('userSuccess', 'Data user berhasil diubah');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/dashboard/users')->with('deleteUser', 'Hapus data user berhasil');
    }

    public function makeAdmin($id)
    {
        $userData = [
            'role_id' => 1,
        ];

        User::where('id', $id)->update($userData);

        return redirect('/dashboard/admin')->with('adminSuccess', 'Data admin berhasil ditambahkan');
    }
}
