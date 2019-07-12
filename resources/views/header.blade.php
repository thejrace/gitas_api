<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dashboard - Bootstrap Admin Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="{{ URL::asset("css/template_includes/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ URL::asset("css/template_includes/bootstrap-responsive.min.css") }}" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
          rel="stylesheet">

    <link href="{{ URL::asset("css/template_includes/font-awesome.css") }}" rel="stylesheet">
    <link href="{{ URL::asset("css/template_includes/style.css") }}" rel="stylesheet">


</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                        class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="">Gitas Admin </a>
            <div class="nav-collapse">
                <ul class="nav pull-right">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                    class="icon-cog"></i> Account <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:;">Settings</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                    class="icon-user"></i> Admin <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:;">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!-- /container -->
    </div>
    <!-- /navbar-inner -->
</div>
<!-- /navbar -->
<div class="subnavbar">
    <div class="subnavbar-inner">
        <div class="container">
            <ul class="mainnav">
                <li @php if( isset($page['api_users']) ) echo 'class="active"'; @endphp><a href=""><i class="icon-group"></i><span>API Users</span> </a> </li>
                <li @php if( isset($page['buses']) ) echo 'class="active"'; @endphp><a href=""><i class="icon-truck"></i><span>Buses</span> </a> </li>
                <li @php if( isset($page['app_modules']) ) echo 'class="active"'; @endphp><a href=""><i class="icon-cloud"></i><span>App Modules</span> </a></li>
            </ul>
        </div>
        <!-- /container -->
    </div>
    <!-- /subnavbar-inner -->
</div>
<!-- /subnavbar -->