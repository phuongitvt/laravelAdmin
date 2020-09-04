<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Role;

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

    public function update(Request $request, $id)
    {
        $menu = Role::find($id);
        $data = $request->all();
        $this->validator($request,$id);
        $menu->name = $data['name'];
        $menu->save();

        $request->session()->flash('status', 'Update success!');

        return redirect()->route("role.edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        Role::destroy($id);
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
