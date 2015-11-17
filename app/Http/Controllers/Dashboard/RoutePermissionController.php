<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Perchecker;

class RoutePermissionController extends DashboardController
{
    public function sync()
    {
        $command = 'php ' . base_path() . '/artisan perchecker:routesync 2>&1';
        $rt      = exec($command);
        return redirect()->route('dashboard.route-permission.index')->with('infos', new MessageBag(["路由同步成功."]));
    }

    public function destroy($routeid)
    {
        $current_route = Perchecker::getRouteModel()->find($routeid);
        if (empty($current_route)) {
            abort(404);
        }
        $current_route->delete();

        return response()->json(['success' => 1]);
    }

    public function edit(Request $request, $routeid)
    {
        $title         = "修改路由权限";
        $current_route = Perchecker::getRouteModel()->find($routeid);
        if (empty($current_route)) {
            abort(404);
        }
        $action       = route('dashboard.route-permission.update', $current_route['id']);
        $permissions1 = Perchecker::getPermissionModel()->where('pre_permission_id', 0)->get();
        return view('dashboard.route-permission.modify', compact('action', 'current_route', 'title', 'permissions1'));
    }

    public function index()
    {
        $routes = Perchecker::getRouteModel()->orderBy('id', 'asc')->paginate(150);

        return view('dashboard.route-permission.index', compact('routes'));
    }

    public function update(Request $request, $routeid)
    {
        $current_route = Perchecker::getRouteModel()->find($routeid);
        if (empty($current_route)) {
            abort(404);
        }
        $rules = $current_route->getValidateRules();
        $this->validate($request, $rules);
        $current_route->fill($request->all());
        $current_route->save();
        return redirect()->route('dashboard.route-permission.edit', $routeid)->with('infos', new MessageBag(["修改路由成功."]));
    }

}
