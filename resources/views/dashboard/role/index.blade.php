@extends('dashboard.default')

@section('style')
<style type="text/css">
  .role-image {
    width: 160px;
    height: 75px;
  }
</style>
@stop

@section('content')
<div class="row">
  <div class="col-sm-12">
      <section class="panel">
          <header class="panel-heading no-border">
              角色列表
              <a href="{{ route('dashboard.role.create') }}" type="button" class="btn btn-success">添加</a>
          </header>
          <table class="table table-bordered">
              <thead>
              <tr>
                  <th>#</th>
                  <th>名称</th>
                  <th>别名</th>
                  <th>权限</th>
                  <th>操作</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($roles as $key => $role)
              <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $role['name'] }}</td>
                  <td>{{ $role['readable_name'] }}</td>
                  <td><a href="{{ route('dashboard.role.show',$role['id']) }}">查看权限</a></td>
                  <td>
                  <a type="button" href="{{ route('dashboard.role.edit',$role['id']) }}" class="btn btn-warning btn-xs"><i class="icon-edit-sign "></i></a>
                  <button type="button"  data-url="{{ route('dashboard.role.destroy',$role['id']) }}" data-name="{{ $role['name'] }}" class="btn btn-danger btn-xs del-btn"><i class="icon-trash "></i></button>
                  </td>
              </tr>
              @endforeach
              </tbody>
          </table>
          <?php echo $roles->render();?>
      </section>
  </div>
</div>
@stop

@section('javascript')
<script type="text/javascript">
$(function () {
  token = '{{ csrf_token() }}';

  $('.del-btn').click(function(){
    if (!confirm("确认要删除？")) {
     window.event.returnValue = false;
    }else{
      del_btn = $(this);
      url = del_btn.data('url');

      formdata = {
        "_token": token
      }

      $.ajax({
          url: url,
          type: 'DELETE',
          dataType: 'json',
          data: formdata,
      })
      .done(function() {
          del_btn.parent().parent().fadeOut(300);
      })
      .fail(function() {
          console.log('false');
      });
    }
    });

})
</script>
@stop