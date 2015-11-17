@extends('dashboard.default')

@section('content')
<div class="row">
  <div class="col-sm-12">
      <section class="panel">
          <header class="panel-heading no-border">
              权限系统路由列表
              <a href="{{ route('dashboard.route-permission.sync') }}" type="button" class="btn btn-success">手动同步</a>
          </header>
          <table class="table table-bordered">
              <thead>
              <tr>
                  <th>#</th>
                  <th>状态</th>
                  <th>唯一识别</th>
                  <th>名称</th>
                  <th>别名</th>
                  <th>操作</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($routes as $key => $route)
              <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $route['status'] }}</td>
                  <td>{{ $route['route_key'] }}</td>
                  <td>{{ $route['name'] }}</td>
                  <td>{{ $route['readable_name'] }}</td>
                  <td>
                  <a type="button" href="{{ route('dashboard.route-permission.edit',$route['id']) }}" class="btn btn-warning btn-xs"><i class="icon-edit-sign "></i></a>
                  </td>
              </tr>
              @endforeach
              </tbody>
          </table>
          <?php echo $routes->render();?>
      </section>
  </div>
</div>
@stop