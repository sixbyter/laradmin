@extends('dashboard.default')

@section('content')
<div class="row">
  <div class="col-sm-12">
      <section class="panel">
          <header class="panel-heading no-border">
              用户列表
              <a href="{{ route('dashboard.user.create') }}" type="button" class="btn btn-success">添加</a>
          </header>
          <table class="table table-bordered">
              <thead>
              <tr>
                  <th>#</th>
                  <th>名称</th>
                  <th>Email</th>
                  <th>角色</th>
                  <th>注册时间</th>
                  <th>权限</th>
                  <th>操作</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($users as $key => $user)
              <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $user['name'] }}</td>
                  <td>{{ $user['email'] }}</td>
                  <td>
                  @foreach($user['roles'] as $role)
                   {{ $role['readable_name'] }},
                  @endforeach
                  </td>
                  <td>{{ $user['created_at'] }}</td>
                  <td><a href="{{ route('dashboard.user.show',$user['id']) }}">查看权限</a></td>
                  <td>
                  <a type="button" href="{{ route('dashboard.user.edit',$user['id']) }}" class="btn btn-warning btn-xs"><i class="icon-edit-sign "></i></a>
                  <button type="button"  data-url="{{ route('dashboard.user.destroy',$user['id']) }}" data-name="{{ $user['name'] }}" class="btn btn-danger btn-xs del-btn"><i class="icon-trash "></i></button>
                  </td>
              </tr>
              @endforeach
              </tbody>
          </table>
          <?php echo $users->render();?>
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