<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Perchecker;

class RoleController extends DashboardController
{

    public function create()
    {
        $title  = "新增角色";
        $role   = Perchecker::getRoleModel();
        $action = route('dashboard.role.store');

        return view('dashboard.role.modify', compact('action', 'role', 'title'));
    }

    public function destroy($roleid)
    {
        $role = Perchecker::getRoleModel()->find($roleid);
        if (empty($role)) {
            abort(404);
        }
        $role->delete();
    }

    public function edit($roleid)
    {
        $title = "修改角色";
        $role  = Perchecker::getRoleModel()->find($roleid);
        if (empty($role)) {
            abort(404);
        }
        $action = route('dashboard.role.update', $role['id']);

        return view('dashboard.role.modify', compact('action', 'role', 'title'));
    }

    public function index()
    {
        $roles = Perchecker::getRoleModel()->paginate(50);

        return view('dashboard.role.index', compact('roles'));
    }

    /**
     * 查看这个角色有什么权限, UI 友好 支持3级权限, 树形权限请参考treePermissions
     * @param  [type] $roleid [description]
     * @return [type]         [description]
     */
    public function show($roleid)
    {
        $role = Perchecker::getRoleModel()->with('permissions')->find($roleid);
        if (empty($role)) {
            abort(404);
        }
        $action      = route('dashboard.role.sync', $role['id']);
        $permissions = $role->getPermissions();
        $permissions = collect($permissions);
        return view('dashboard.role.show', compact('role', 'action', 'permissions'));
    }

    public function store(Request $request)
    {
        $role  = Perchecker::getRoleModel();
        $rules = $role->getValidateRules();
        $this->validate($request, $rules);
        $role->fill($request->all());
        $role->save();
        return redirect()->route('dashboard.role.index');
    }

    public function sync(Request $request, $roleid)
    {
        $role = Perchecker::getRoleModel()->find($roleid);
        if (empty($role)) {
            abort(404);
        }
        $permissions = $request->input('permissionid', []);
        $role->permissions()->sync($permissions);

        return redirect()->route('dashboard.role.show', $roleid)->with('infos', new MessageBag(["设置权限成功"]));
    }

    public function update(Request $request, $roleid)
    {
        $role = Perchecker::getRoleModel()->find($roleid);
        if (empty($role)) {
            abort(404);
        }
        $rules = $role->getValidateRules();
        $this->validate($request, $rules);
        $role->fill($request->all());
        $role->save();
        return redirect()->route('dashboard.role.edit', $roleid);
    }

}
