<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="sixbyte">

    <title>每日Q游戏-游戏库</title>
    <base href="{{ asset('templates/flatlab') }}/index.html">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-switch.min.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    @section('head')
    @show
  </head>

  <body>

  <section id="container" >
      <!--header start-->
      <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <a href="{{ route('dashboard.welcome') }}" class="logo">每日<span>Q</span>游戏</a>
            <!--logo end-->
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="img/avatar1_small.jpg">
                            <span class="username">{{ Request::user()['name'] }}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class=" icon-suitcase"></i>修改密码</a></li>
                            <li><a href="#"><i class="icon-cog"></i> 设置</a></li>
                            <li><a href="#"><i class="icon-bell-alt"></i> 角色名</a></li>
                            <li><a href="{{ url('auth/logout') }}"><i class="icon-key"></i> 退出登录</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
      </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">

                  <li>
                      <a @if(Request::is('dashboard/welcome')) class="active" @endif href="{{ route('dashboard.welcome') }}">
                          <i class="icon-smile"></i>
                          <span>Welcome</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" @if(Request::is('dashboard/role*')||
                      Request::is('dashboard/permission*')||
                      Request::is('dashboard/user*')||
                      Request::is('dashboard/route-permission*')) class="active" @endif>
                          <i class="icon-user"></i>
                          <span>权限管理</span>
                      </a>
                      <ul class="sub">
                          <li @if(Request::is('dashboard/user*')) class="active" @endif>
                            <a href="{{ route('dashboard.user.index') }}">用户管理</a>
                          </li>
                          <li @if(Request::is('dashboard/permission*')) class="active" @endif>
                            <a href="{{ route('dashboard.permission.index') }}">权限管理</a>
                          </li>
                          <li @if(Request::is('dashboard/role*')) class="active" @endif>
                            <a href="{{ route('dashboard.role.index') }}">角色管理</a>
                          </li>
                          <li @if(Request::is('dashboard/route-permission*')) class="active" @endif>
                            <a href="{{ route('dashboard.route-permission.index') }}">路由权限管理</a>
                          </li>
                      </ul>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              @if($errors->count())
              <div class="alert alert-danger fade in">
                  {{ $errors->first() }}
              </div>
              @endif
              @if($infos->count())
              <div class="alert alert-info fade in">
                  {{ $infos->first() }}
              </div>
              @endif
              @if($warnings->count())
              <div class="alert alert-warning fade in">
                  {{ $warnings->first() }}
              </div>
              @endif
              @section('content')
              @show
          </section>
      </section>
      <!--main content end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-switch.min.js"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/respond.min.js" ></script>

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

    @section('javascript')
    @show


  </body>
</html>
