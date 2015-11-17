@extends('dashboard.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">{{ $role['readable_name'] }}({{ $role['name'] }})</header>
            <div class="panel-body">
                <form class="form-horizontal tasi-form" method="post" action="{{ $action }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @foreach($permissions->where('pre_permission_id',0)->all() as $permission1)
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <h3 style="margin: 0px;padding-left: 13px;color: #37AAD3;">
                                <input name="permissionid[]" type="checkbox" @if($permission1['can']) checked @endif value="{{$permission1['id']}}"> {{ $permission1['readable_name'] }}({{$permission1['name']}})</h3>
                            </label>
                        </div>
                    </div>
                        @foreach($permissions->where('pre_permission_id',$permission1['id'])->all() as $permission2)
                        <div class="form-group">
                          <label class="col-sm-2 control-label col-lg-2" >
                          <h4 style="margin: 0px;padding-left: 13px;">
                           <input name="permissionid[]" type="checkbox" @if($permission2['can']) checked @endif value="{{$permission2['id']}}">
                           {{ $permission2['readable_name'] }}({{$permission2['name']}})
                          </h4>
                          </label>
                          <div class="col-sm-10">
                            <div class="row">
                          @foreach($permissions->where('pre_permission_id',$permission2['id'])->all() as $permission3)
                            <div class="col-sm-3">
                              <div class="checkbox">
                                  <label>
                                      <input name="permissionid[]" type="checkbox" @if($permission3['can']) checked @endif value="{{$permission3['id']}}">
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
