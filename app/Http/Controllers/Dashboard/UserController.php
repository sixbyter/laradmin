<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Perchecker;

/**
 * 后台用户管理, 非注册登录入口
 */
class UserController extends DashboardController
{

    public function create(Request $request)
    {
        $user   = new User;
        $title  = '添加用户';
        $action = route('dashboard.user.store');
        $roles  = Perchecker::getRoleModel()->limit(50)->get();
        return view('dashboard.user.modify', compact('action', 'user', 'title', 'roles'));
    }

    public function destroy(Request $request, $userid)
    {
        $user = User::find((int) $userid);
        if (empty($user)) {
            abort(404);
        }
        $user->delete();
    }

    public function edit(Request $request, $userid)
    {
        $user = User::find((int) $userid);
        if (empty($user)) {
            abort(404);
        }
        $title  = '修改用户信息';
        $action = route('dashboard.user.update', $userid);
        $roles  = Perchecker::getRoleModel()->limit(50)->get();
        return view('dashboard.user.modify', compact('action', 'user', 'title', 'roles'));
    }

    public function index(Request $request)
    {
        $users = User::with('roles')->paginate(20);
        return view('dashboard.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $user  = new User;
        $rules = [
            'name'     => 'required',
            'email'    => 'required|email',
            'roles_id' => 'array',
            'password' => 'required|min:6|confirmed',
        ];
        $this->validate($request, $rules);
        $user->name     = $request->input('name');
        $user->email    = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        $user->roles()->sync($request->input('roles_id'));
        return redirect()
            ->route('dashboard.user.index')
            ->with('infos', new MessageBag(["新增用户" . $user['name']]));
    }

    public function update(Request $request, $userid)
    {
        $user = User::find((int) $userid);
        if (empty($user)) {
            abort(404);
        }
        $rules = [
            'name'     => 'required',
            'email'    => 'required|email',
            'roles_id' => 'array',
            'password' => 'min:6|confirmed',
        ];
        $this->validate($request, $rules);
        $user->name     = $request->input('name');
        $user->email    = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        $user->roles()->sync($request->input('roles_id'));
        return redirect()
            ->route('dashboard.user.edit', $userid)
            ->with('infos', new MessageBag(["修改用户信息成功."]));
    }

    public function show(Request $request, $userid)
    {
        $user = User::find((int) $userid);
        if (empty($user)) {
            abort(404);
        }
        $action      = route('dashboard.user.sync', $userid);
        $permissions = $user->getPermissions();
        $permissions = collect($permissions);
        return view('dashboard.user.show', compact('user', 'action', 'permissions'));
    }

    public function sync(Request $request, $userid)
    {
        $user = User::find((int) $userid);
        if (empty($user)) {
            abort(404);
        }
        $user->permissions()->sync((array) $request->input('permission_id'));
        return redirect()
            ->route('dashboard.user.show', $userid)
            ->with('infos', new MessageBag(["修改用户私有权限成功."]));
    }
}
