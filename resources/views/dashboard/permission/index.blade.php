@extends('dashboard.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
            权限列表
            <a href="{{ route('dashboard.permission.create') }}" type="button" class="btn btn-success">添加</a>
            </header>
            <div class="panel-body">
                <form class="form-horizontal tasi-form">
                    @foreach($permissions1 as $permission1)
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <h3 style="margin: 0px;color: #37AAD3;">
                                <a href="{{ route('dashboard.permission.create',['pre_permission_id'=>$permission1['id']]) }}"
                                    type="button"
                                    class="btn btn-success btn-xs">追加</a>
                                <a href="{{ route('dashboard.permission.edit',$permission1['id']) }}">
                                {{ $permission1['readable_name'] }}({{$permission1['name']}})
                                </a>

                                </h3>
                            </label>
                        </div>
                    </div>
                        @foreach($permission1->sons as $permission2)
                        <div class="form-group">
                          <label class="col-sm-2 control-label col-lg-2" >
                          <h4 style="margin: 0px;padding-left: 13px;">
                            <a href="{{ route('dashboard.permission.create',['pre_permission_id'=>$permission2['id']]) }}"
                                    type="button"
                                    class="btn btn-success btn-xs">追加</a>
                            <a href="{{ route('dashboard.permission.edit',$permission2['id']) }}">
                           {{ $permission2['readable_name'] }}({{$permission2['name']}})
                            </a>

                          </h4>
                          </label>
                          <div class="col-sm-10">
                            <div class="row">
                          @foreach($permission2->sons as $permission3)
                            <div class="col-sm-3">
                              <div class="checkbox">
                                  <label>
                                    <a href="{{ route('dashboard.permission.edit',$permission3['id']) }}">
                                      {{ $permission3['readable_name'] }}<br />({{$permission3['name']}})
                                    </a>
                                  </label>
                              </div>
                            </div>
                          @endforeach
                            </div>
                          </div>
                        </div>
                        @endforeach
                    @endforeach
                </form>
            </div>
        </section>
    </div>
</div>
@stop
