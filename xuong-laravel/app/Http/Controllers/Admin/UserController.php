<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    const PARTH_VIEW = 'admin.users.';

    public function index()
    {

        $data = User::latest('id')->paginate(5);

        return view(self::PARTH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PARTH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'type' => 'required|boolean', // kiểm tra type là boolean
        ]);

        try {
            // Lấy dữ liệu và mã hóa mật khẩu
            $data = $request->only(['name', 'email', 'type']);
            $data['password'] = bcrypt($request->input('password'));

            // Tạo mới user
            User::create($data);

            return redirect()->route('admin.users.index')
                ->with('success', 'User created successfully');
        } catch (\Throwable $th) {
            return back()->with('success', 'Error occurred while creating user');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {

            $data = $request->all();

            $user->update($data);

            return redirect()->route('admin.users.index')
                ->with('success', 'true');
        } catch (\Throwable $th) {
            return back()->with('success', 'false');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {

            $user->delete();

            return redirect()->route('admin.users.index')
                ->with('success', 'true');
        } catch (\Throwable $th) {
            return back()->with('success', 'false');
        }
    }
}
