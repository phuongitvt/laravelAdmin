<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Menu;
use App\Models\Admin\Role;
use App\User;
use App\Models\Admin\UserRole;
use App\Models\Admin\UserVsMenu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::with('role')->paginate(15);
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
        $user = User::with('menus')->with(['role','menus'])->find($id);
        $role = Role::all();
        $menuNows = $user->menus;

        $roleNow = $user->role;

        $temp = $menuNows ? $menuNows->pluck("id") : [];
        $menus = Menu::whereNotIn('id', $temp)->get();

        return view("admins.user.control", ["user" => $user, "roles" => $role,"roleNow" => $roleNow, "menus" => $menus, "menuNows" => $menuNows]);
    }

    public function updateControl(Request $request, $id)
    {
        $data = $request->all();
        if(isset($data["role"])){
            $UserRole = UserRole::firstWhere('id_user', $id);
            if(!$UserRole){
                $UserRole = new UserRole();
                $UserRole->id_user = $id;
            }
            $UserRole->id_role = $data["role"];
            $UserRole->save();
        }

        $request->session()->flash('status', 'Update success!');

        return redirect()->route("user.control", ['id' => $id]);
    }

    public function addMenu(Request $request, $id)
    {
       $list = $request->all();
       if(!$list['list']){
           return false;
       }
       $data = [];
       foreach ($list['list'] as $k => $value){
           $data[] = ['id_menu' => $value, 'id_user' => $id];
       }
       $table = UserVsMenu::getTableName();
       DB::table($table)->insert($data);
       return true;
    }

    public function removeMenu(Request $request, $id)
    {
        $list = $request->all();
        if(!$list['list']){
            return false;
        }
        $table = UserVsMenu::getTableName();
        DB::table($table)->whereIn('id_menu', $list['list'])->where('id_user',$id)->delete();
        return true;
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
