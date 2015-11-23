@extends('dashboard.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">{{ $title }}</header>
            <div class="panel-body">
                <form class="form-horizontal tasi-form" enctype="multipart/form-data" method="post" action="{{ $action }}">
                    @if (!empty($current_route['id'])) <input type="hidden" name="_method" value="PUT"> @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group ">
                        <div class="col-sm-6">
                            <label for="name">名称</label>
                            <input type="text" class="form-control"  value="{{ $current_route['name'] }}"  disabled>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-sm-6">
                            <label for="route_key">唯一识别码</label>
                            <input type="text" class="form-control"  value="{{ $current_route['route_key'] }}" disabled>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-sm-6">
                            <label for="readable_name">别名</label>
                            <input type="text" class="form-control"  value="{{ old('readable_name', $current_route['readable_name']) }}" id="readable_name" name="readable_name" required placeholder="超级用户">
                            @if ($errors->has('readable_name'))
                                <span class="text-danger">{{ $errors->first('readable_name') }}</span>
                            @endif
                        </div>
                    </div>
                    @foreach($permissions->where('pre_permission_id',0) as $permission1)
                    <div class="form-group">
                        <div class="radio">
                            <label>
                                <h3 style="margin: 0px;padding-left: 13px;color: #37AAD3;">
                                <input name="permission_id" type="radio" @if($current_route['permission_id'] === $permission1['id']) checked @endif value="{{$permission1['id']}}"> {{ $permission1['readable_name'] }}({{$permission1['name']}})</h3>
                            </label>
                        </div>
                    </div>
                        @foreach($permissions->where('pre_permission_id',$permission1['id']) as $permission2)
                        <div class="form-group">
                          <label class="col-sm-2 control-label col-lg-2" >
                          <h4 style="margin: 0px;padding-left: 13px;">
                           <input name="permission_id" type="radio" @if($current_route['permission_id'] === $permission2['id']) checked @endif value="{{$permission2['id']}}">
                           {{ $permission2['readable_name'] }}({{$permission2['name']}})
                          </h4>
                          </label>
                          <div class="col-sm-10">
                            <div class="row">
                          @foreach($permissions->where('pre_permission_id',$permission2['id']) as $permission3)
                            <div class="col-sm-3">
                              <div class="radio">
                                  <label>
                                      <input name="permission_id" type="radio" @if($current_route['permission_id'] === $permission3['id']) checked @endif value="{{$permission3['id']}}">
                                      {{ $permission3['readable_name'] }}<br />({{$permission3['name']}})
                                  </label>
                              </div>
                            </div>
                          @endforeach
                            </div>
                          </div>
                        </div>
                        @endforeach
                    @endforeach
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
