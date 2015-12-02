@extends('dashboard.default')

@section('head')
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
      <section class="panel">
          <header class="panel-heading">
              欢迎光临
          </header>
          <div class="panel-body">
              laradmin
              @percheckcan("app.add")
              @endpercheckcan
              @percheckcan("app.group")
              @endpercheckcan
              @percheckcan("app.edit")
              @endpercheckcan
              @percheckcan("app.index")
              @endpercheckcan
              @percheckcan("banner")
              @endpercheckcan
              @percheckcan("app.add")
              @endpercheckcan
              @percheckcan("app.group")
              @endpercheckcan
              @percheckcan("app.edit")
              @endpercheckcan
              @percheckcan("app.index")
              @endpercheckcan
              @percheckcan("banner")
              @endpercheckcan

              @percheckcan("app.add")
              @endpercheckcan
              @percheckcan("app.group")
              @endpercheckcan
              @percheckcan("app.edit")
              @endpercheckcan
              @percheckcan("app.index")
              @endpercheckcan
              @percheckcan("banner")
              @endpercheckcan
              @percheckcan("app.add")
              @endpercheckcan
              @percheckcan("app.group")
              @endpercheckcan
              @percheckcan("app.edit")
              @endpercheckcan
              @percheckcan("app.index")
              @endpercheckcan
              @percheckcan("banner")
              @endpercheckcan
          </div>
      </section>
  </div>
</div>
@stop
