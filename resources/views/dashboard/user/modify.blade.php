@extends('dashboard.default')

@section('head')
<link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/css/multi-select.css">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">{{ $title }}</header>
            <div class="panel-body">
                <form class="form-horizontal tasi-form" enctype="multipart/form-data" method="post" action="{{ $action }}">
                    @if (!empty($user['id'])) <input type="hidden" name="_method" value="PUT"> @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="col-sm-8">
                            <label for="email">邮箱</label>
                            <input type="text" class="form-control"  value="{{ old('email', $user['email']) }}" name="email" required placeholder="请输入邮箱,登录使用邮箱">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-sm-8">
                            <label for="name">昵称</label>
                            <input type="text" class="form-control"  value="{{ old('name', $user['name']) }}" id="name" name="name" required placeholder="请输入昵称">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-sm-8">
                            <label for="password">密码</label>
                            <input type="password" class="form-control" id="password" name="password" @if (empty($user['id'])) required @endif placeholder="请输入密码">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-sm-8">
                            <label for="password_confirmation">确认密码</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" @if (empty($user['id'])) required @endif placeholder="请输入密码">
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-sm-8">
                        <label for="human_limit">选择角色</label>
                            <select multiple="multiple" class="multi-select" id="select" name="roles_id[]">
                                @foreach($roles as $role)
                                <option value="{{ $role['id'] }}" @if($user->hasRole($role['id'])) selected @endif >{{ $role['readable_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-danger" type="submit">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@stop

@section('javascript')
<script type="text/javascript" src="assets/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
<script type="text/javascript">
$(function () {
  $('.multi-select').multiSelect();
})
</script>
@stop
