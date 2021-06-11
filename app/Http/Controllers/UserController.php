<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('user.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'password' => 'required|min:8|max:20',
            'email' => 'nullable|email|unique:users'
        ]);
        $Hashed_password = Hash::make($request->password);
        User::create(['full_name' => $request->full_name, 'password' => $Hashed_password, 'email' => $request->email]);
        flash('User Created')->success();
        return redirect()->to('/users');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $old_email = $user->email;
        $new_email = $request->email;


        if (!empty($request->full_name)) {
            $data = $request->validate(['full_name' => 'required']);
            $user->update($data);
        }
        if (!empty($request->password)){
            if (!Hash::check($request->password, auth()->user()->password)) {
                $request->validate(['password' => 'required|min:8|max:20']);
                $Hashed_password = Hash::make($request->password);
                $user->update(['password' => $Hashed_password]);
            }
        }

        if ($old_email == $new_email) {
            $data = $request->validate(['email' => 'nullable|email']);
        } else {
            $data = $request->validate(['email' => 'email|unique:users']);
            $user->update($data);
        }
        if ($user->wasChanged()) {
            flash('User Updated')->success();
            return redirect()->to('/users');
        } else {
            flash('Nothing Changed')->error();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        flash('User Deleted')->success();
        return redirect()->to('/users');
    }
}
