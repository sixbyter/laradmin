<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Perchecker;

class PermissionController extends DashboardController
{

    public function create(Request $request)
    {
        $title              = "添加权限";
        $current_permission = Perchecker::getPermissionModel();
        $action             = route('dashboard.permission.store');

        $permissions = Perchecker::getAllPermissions();

        $selected_pre_permission_id = (int) old('pre_permission_id', $request->input('pre_permission_id', 0));
        return view('dashboard.permission.modify', compact('action', 'current_permission', 'title', 'permissions', 'selected_pre_permission_id'));
    }

    public function destroy(Request $request, $permissionid)
    {
        $current_permission = Perchecker::getPermissionModel()->find($permissionid);
        if (empty($current_permission)) {
            abort(404);
        }
        $current_permission->delete();

        return redirect()->route('dashboard.permission.index')->with('warnings', new MessageBag(["权限删除成功."]));
    }

    public function edit(Request $request, $permissionid)
    {

        $title              = "修改权限";
        $current_permission = Perchecker::getPermissionModel()->find($permissionid);
        if (empty($current_permission)) {
            abort(404);
        }
        $action                     = route('dashboard.permission.update', $current_permission['id']);
        $permissions                = Perchecker::getAllPermissions();
        $selected_pre_permission_id = (int) old('pre_permission_id', $current_permission['pre_permission_id']);
        return view('dashboard.permission.modify', compact('action', 'current_permission', 'title', 'permissions', 'selected_pre_permission_id'));
    }

    public function index()
    {
        $permissions = Perchecker::getAllPermissions();
        return view('dashboard.permission.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $permission = Perchecker::getPermissionModel();
        $rules      = $permission->getValidateRules();
        $this->validate($request, $rules);
        $permission->fill($request->all());
        $permission->save();
        return redirect()
            ->route('dashboard.permission.index')
            ->with('infos', new MessageBag(["新增权限 " . $permission['name'] . '.']));
    }

    public function update(Request $request, $permissionid)
    {
        $permission = Perchecker::getPermissionModel()->find($permissionid);
        if (empty($permission)) {
            abort(404);
        }
        $rules = $permission->getValidateRules();
        $this->validate($request, $rules);
        $permission->fill($request->all());
        $permission->save();
        return redirect()
            ->route('dashboard.permission.edit', $permissionid)
            ->with('infos', new MessageBag(["修改权限 " . $permission['name'] . ' 成功.']));
    }

}
