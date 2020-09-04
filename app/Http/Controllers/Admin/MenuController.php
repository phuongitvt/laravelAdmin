<?php

namespace App\Http\Controllers\Admin;

use App\GroupMenu;
use App\User;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $menus = Menu::paginate(15);

        return view('admins.menu.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $groups = GroupMenu::all();
        return view("admins.menu.create", ["groups" => $groups]);
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
        if (Menu::create([
            'name' => $data['name'],
            'group' => $data['group'],
            'description' => $data['description']
        ])) {
            $request->session()->flash('status', 'Update success!');
            return redirect()
                ->route("menu.index");
        }
        return redirect()
            ->route("menu.create");
    }

    private function validator(Request $request, $id = null)
    {
        //validation rules.
        $rules = [
            'name' => 'required|min:3|max:191|unique:menus' . ($id ? ",$id,id" : ''),
            'group' => 'required|string',
            'description' => 'nullable|string|max:255',
        ];

        //validate the request.
        $request->validate($rules);
    }
    private function validatorUpdate(Request $request, $id)
    {
        //validation rules.
        $rules = [
            'name' => 'required|min:3|max:191|unique:menus,name,'.$id,
            'group' => 'required|string',
            'description' => 'nullable|string|max:255',
        ];

        //validate the request.
        $request->validate($rules);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $groups = GroupMenu::all();
        $menu = Menu::find($id);
        $request->session()->flash('status', 'Update success!');
        return view("admins.menu.edit", ["groups" => $groups, "menu" => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        $data = $request->all();
        $this->validatorUpdate($request,$id);
        $menu->name = $data['name'];
        $menu->group = $data['group'];
        $menu->description = $data['description'];
        $menu->save();

        return redirect()->route("menu.edit", ['id' => $id])->with("message", "Update success!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        Menu::destroy($id);
        return redirect()->route("menu.index");
    }
}
