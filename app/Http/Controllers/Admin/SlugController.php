<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Slug;
use App\Models\Admin\Permission;

class SlugController extends Controller
{
    public function index()
    {
        $slugs = Slug::with("permissions")->paginate(15);

        return view('admins.slug.index', ['slugs' => $slugs]);
    }

    public function create()
    {
        return view("admins.slug.create");
    }

    public function createProcess(Request $request)
    {
        $data = $request->all();
        $this->validator($request);
        $slug = new Slug();
        $slug->name = $data['name'];
        if ($slug->save()) {
            return redirect()
                ->route("slug.edit", ['id' => $slug->id])->with("status", "You has create Slug");
        }
        return redirect()
            ->route("slug.create");
    }

    public function edit($id)
    {
        $slug = Slug::find($id);
        return view("admins.slug.edit", ["slug" => $slug]);
    }

    public function update(Request $request, $id)
    {
        $menu = Slug::find($id);
        $data = $request->all();
        $this->validator($request, $id);
        $menu->name = $data['name'];
        $menu->save();

        $request->session()->flash('status', 'Update success!');

        return redirect()->route("slug.edit", ['id' => $id]);
    }

    public function addPermission(Request $request)
    {
        $data = $request->all();
        $permission = new Permission();
        $permission->name = $data["name"];
        $permission->id_slug = $data["id_slug"];
        $permission->full_name = $data['slug_name'] . "." . $data['name'];
        if ($permission->save()) {
            return response()->json(['success' => true, 'id' => $permission->id]);
        }
        return response()->json(['success' => false]);
    }

    public function removePermission(Request $request)
    {
        $data = $request->all();
        if (Permission::destroy($data['id'])) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        Slug::destroy($id);
        return redirect()->route("slug.index");
    }


    private function validator(Request $request, $id = null)
    {
        //validation rules.
        $rules = [
            'name' => 'required|min:3|max:191|unique:slugs' . ($id ? ",name,$id" : ''),
        ];

        //validate the request.
        $request->validate($rules);
    }
}
