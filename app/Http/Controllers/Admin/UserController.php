<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\Role;
use App\User;
use App\UserVsMenu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::paginate(15);

        return view('admins.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("admins.user.create");
    }

    public function createProcess(Request $request)
    {
        $data = $request->all();
        $this->validator($request);

        $user = new User();
        $user->user_name = $data['user_name'];
        $user->email = $data['email'];
        $hashed = Hash::make($data['password'], [
            'rounds' => 12,
        ]);
        $user->password = $hashed;

        if ($user->save()) {
            return redirect()->route("admins.user.create");
        }
        return view("admins.user.create");
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view("admins.user.edit", ["user" => $user]);
    }

    public function update(Request $request, $id)
    {
        $menu = Slug::find($id);
        $data = $request->all();
        $this->validator($request, $id);
        $menu->name = $data['name'];
        $menu->save();

        $request->session()->flash('status', 'Update success!');

        return redirect()->route("user.edit", ['id' => $id]);
    }

    public function control($id)
    {
        $user = User::with('menus')->find($id);
        $roles = Role::all();
        $menus = Menu::all();
        $menuNow = $user->menus;
        if($menuNow){
            $menuNow = $menuNow->pluck('name');
        }
        return view("admins.user.control", ["user" => $user, "roles" => $roles, "menus" => $menus]);
    }

    private function validator(Request $request, $id = null)
    {
        $rules = [
            'user_name' => 'required|min:3|max:191|unique:users' . ($id ? ",user_name,$id" : ''),
            'email' => 'required|min:3|max:191|unique:users' . ($id ? ",email,$id" : ''),
            'password' => 'required|min:6|max:191|confirmed'
        ];

        //validate the request.
        $request->validate($rules);
    }
}
