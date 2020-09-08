<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $permissions = Permission::paginate(15);

        return view('admins.permission.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("admins.permission.create");
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
        if (Permission::create([
            'name' => $data['name'],
            'full_name' => $data['slug_name'].".".$data['name'],
            'slug' => $data['slug'],
            'description' => $data['description']
        ])) {
            return redirect()
                ->route("permission.index")->with("status", "You has create permission");
        }
        return redirect()
            ->route("permission.create");
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        return view("admins.permission.edit", ["permission" => $permission]);
    }

    public function update(Request $request, $id)
    {
        $menu = Permission::find($id);
        $data = $request->all();
        $this->validator($request,$id);
        $menu->name = $data['name'];
        $menu->slug = $data['slug'];
        $menu->description = $data['description'];
        $menu->save();

        $request->session()->flash('status', 'Update success!');

        return redirect()->route("permission.edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        Permission::destroy($id);
        return redirect()->route("permission.index");
    }


    private function validator(Request $request, $id = null)
    {
        //validation rules.
        $rules = [
            'name' => 'required|min:3|max:191|unique:roles' . ($id ? ",name,$id" : ''),
            'slug' => 'required|string|max:100',
            'description' => 'max:255|string'
        ];

        //validate the request.
        $request->validate($rules);
    }
}
