@extends('dashboard.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
            {{ $title }}
            @if (!empty($current_permission['id']))
            <form style="float:right;" class="form-horizontal tasi-form" method="post" action="{{ route('dashboard.permission.destroy',$current_permission['id']) }}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-danger" type="submit">删除</button>
                    </div>
                </div>
            </form>
            @endif
            </header>
            <div class="panel-body">
                <form class="form-horizontal tasi-form" method="post" action="{{ $action }}">
                    @if (!empty($current_permission['id'])) <input type="hidden" name="_method" value="PUT"> @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="pre_permission_id">父级权限</label>
                            <select class="form-control m-bot15" name="pre_permission_id">
                                <option value="0">none</option>
                                @foreach($permissions->where('pre_permission_id', 0) as $permission1)
                                <option @if($selected_pre_permission_id === $permission1['id']) selected @endif value="{{ $permission1['id'] }}">{{ $permission1['readable_name'] }}</option>
                                    @foreach($permissions->where('pre_permission_id', $permission1['id']) as $permission2)
                                        <option @if($selected_pre_permission_id === $permission2['id']) selected @endif value="{{ $permission2['id'] }}">--{{ $permission2['readable_name'] }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            @if ($errors->has('pre_permission_id'))
                                <span class="text-danger">{{ $errors->first('pre_permission_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="name">代码名称</label>
                            <input type="text" class="form-control"  value="{{ old('name', $current_permission['name']) }}" name="name" required placeholder="dashboard.permission.index">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-sm-6">
                            <label for="readable_name">别名</label>
                            <input type="text" class="form-control"  value="{{ old('readable_name', $current_permission['readable_name']) }}" id="readable_name" name="readable_name" required placeholder="权限列表">
                            @if ($errors->has('readable_name'))
                                <span class="text-danger">{{ $errors->first('readable_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@stop
