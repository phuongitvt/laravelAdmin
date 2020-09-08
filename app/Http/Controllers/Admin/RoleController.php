<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Permission;
use App\Models\Admin\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::paginate(15);

        return view('admins.role.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("admins.role.create");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function createProcess(Request $request)
    {
        $data = $request->all();
        $this->validator($request);
        if (Role::create([
            'name' => $data['name']
        ])) {
            return redirect()
                ->route("role.index")->with("status", "You has create role");
        }
        return redirect()
            ->route("role.create");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return view("admins.role.edit", ["role" => $role]);
    }

    public function control($id)
    {
        $role = Role::with('permissions')->find($id);
        $permissionNows = $role?$role->permissions:null;

        $temp = $permissionNows ? $permissionNows->pluck("id") : [];
        $permissions = Permission::whereNotIn('id', $temp)->get();
        return view("admins.role.control", ["role" => $role, "permissionNows" => $permissionNows, "permissions" => $permissions]);
    }

    public function update(Request $request, $id)
    {
        $menu = Role::find($id);
        $data = $request->all();
        $this->validator($request, $id);
        $menu->name = $data['name'];
        $menu->save();

        $request->session()->flash('status', 'Update success!');

        return redirect()->route("role.edit", ['id' => $id]);
    }

    public function addPermission(Request $request, $id)
    {
        $list = $request->all();
        if(!$list['list']){
            return false;
        }
        $data = [];
        foreach ($list['list'] as $k => $value){
            $data[] = ['id_permission' => $value, 'id_role' => $id];
        }
        $table = RolePermission::getTableName();
        DB::table($table)->insert($data);
        return true;
    }

    public function removePermission(Request $request, $id)
    {
        $list = $request->all();
        if(!$list['list']){
            return false;
        }
        $table = RolePermission::getTableName();
        DB::table($table)->whereIn('id_permission', $list['list'])->where('id_role',$id)->delete();
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request,$id)
    {
        if(Role::where('fix',0)->where('id',$id)->delete()){
            $request->session()->flash('status', 'Delete success!');
        }else{
            $request->session()->flash('status', 'Can\'t delete this role!');
        }

        return redirect()->route("role.index");
    }

    private function validator(Request $request, $id = null)
    {
        //validation rules.
        $rules = [
            'name' => 'required|min:3|max:191|unique:roles' . ($id ? ",name,$id" : ''),
        ];

        //validate the request.
        $request->validate($rules);
    }
}
