@extends('dashboard.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">{{ $title }}</header>
            <div class="panel-body">
                <form class="form-horizontal tasi-form" enctype="multipart/form-data" method="post" action="{{ $action }}">
                    @if (!empty($role['id'])) <input type="hidden" name="_method" value="PUT"> @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="name">代码名称</label>
                            <input type="text" class="form-control"  value="{{ old('name', $role['name']) }}" name="name" required placeholder="superuser">
                            @if (!empty($role['id'])) <span class="text-danger">修改会影响整个后台的权限判断, 请足够理解你现在在做什么</span>@endif
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-sm-6">
                            <label for="readable_name">别名</label>
                            <input type="text" class="form-control"  value="{{ old('readable_name', $role['readable_name']) }}" id="readable_name" name="readable_name" required placeholder="超级用户">
                            @if ($errors->has('readable_name'))
                                <span class="text-danger">{{ $errors->first('readable_name') }}</span>
                            @endif
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
