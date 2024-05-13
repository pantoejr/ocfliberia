<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function users()
    {
        $users = User::all();
        return view('account.users', [
            'title' => 'List of Users',
            'users' => $users,
        ]);
    }

    public function register()
    {
        $roles = Role::pluck('name', 'id');

        return view('account.register', [
            'title' => 'Register User',
            'roles' => $roles,
        ]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'imagePath' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'contact' => 'required|min:10',
            'address' => 'required',
        ]);

        $path = $request->file('imagePath')->store('images', 'public');
        $is_active = $request->is_active ? 1 : 0;

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'address' => $request->input('address'),
            'role_id' => $request->input('role_id'),
            'imagePath' => $path,
            'password' => Hash::make($request->password),
            'login_hint' => $request->password,
            'is_active' => $is_active,
        ]);

        $user->save();
        return redirect('account/users')->with('msg', 'User created successfully')->with('flag', 'alert-success');
    }

    public function login()
    {
        return view('account.login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials) && User::where('email', $credentials['email'])->first()->is_active) {
            $request->session()->regenerate();
            return redirect()->route('home.dashboard')->with('msg', 'You have successfully logged in!')->with('flag', 'alert-success');
        }
        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->route('home.dashboard')->with('msg', 'You have successfully logged in!')->with('flag', 'alert-success');
        // }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login')->with('success', 'Logged out successfully.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'id');
        return view('account.edit', compact('roles'), [
            'title' => 'Edit User',
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        try{

            $user = User::find($id);
            if($request->hasFile('imagePath')){
                if($user->imagePath){
                    Storage::disk('storage')->delete($user->imagePath);
                }

                $path = $request->file('imagePath')->store('images','public');
                $user->imagePath = $path;
            }
            $isActive = $request->is_active ? 1 : 0;
            $user->email = $request->email;
            $user->contact = $request->contact;
            $user->role_id = $request->role_id;
            $user->address = $request->address;
            $user->name = $request->name;
            $user->is_active = $isActive;
            $user->save();

        }catch(Exception $ex){
            return back()->with('msg','Error: '. $ex->getMessage())->with('flag','alert-danger');
        }
        return redirect('account/users')->with('msg', 'User updated successfully')->with('flag', 'alert-success');
    }


    public function details($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'id');
        return view('account.details', compact('roles'), [
            'title' => 'User Details',
            'user' => $user,
        ]);
    }



    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users')->with('msg', 'User deleted successfully');
    }

    public function changePassword()
    {
        return view('account.changepassword', [
            'title' => 'Change Password'
        ]);
    }


    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
            'login_hint' => $request->new_password,
        ]);

        return back()->with('msg', 'Password changed successfully!')->with('flag','alert-success');
    }
}
