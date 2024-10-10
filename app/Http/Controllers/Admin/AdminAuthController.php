<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;

class AdminAuthController extends Controller
{
    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function getUser()
    {
        return view('admin.user.index', [
            'user' => User::latest()->get()
        ]);
    }

    public function addUser()
    {
        $groups = Company::all();
        return view('admin.user.store', compact('groups'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'id_group' => 'required',
            'email' =>'required|email|unique:users',
            'password' => 'required',
            'customer_name' =>'required',
            'pic_name' => 'required',
            'pic_phone' => 'required',
            'address' => 'required',
            'role' => "required|in:admin,retail,supermarket"
        ]);

        User::create([
            'id_group' => $request->id_group,
            'email' =>$request->email,
            'password' =>$request->password,
            'customer_name' =>$request->customer_name,
            'pic_name' =>$request->pic_name,
            'pic_phone' =>$request->pic_phone,
            'address' =>$request->address,
            'role' => $request->role,
        ]);

        return redirect()->route('getUser')->with('message', 'Data Added Successfully');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.update', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'id_group' => 'required',
            'email' =>'required|email',
            'password' => 'required',
            'customer_name' =>'required',
            'pic_name' => 'required',
            'pic_phone' => 'required',
            'address' => 'required',
            'role' => "required|in:admin,retail,supermarket"
        ]);

        $user->id_group = $request->id_group;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->customer_name = $request->customer_name;
        $user->pic_name = $request->pic_name;
        $user->pic_phone = $request->pic_phone;
        $user->address = $request->address;
        $user->role = $request->role;

        $user->save();

        return redirect()->route('getUser')->with('message', 'User Updated Successfully');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('getUser')->with('message', 'User deleted successfully');
    }
}
