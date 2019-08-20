<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Gitas API Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ URL::asset("css/template_includes/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ URL::asset("css/template_includes/bootstrap-responsive.min.css") }}" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
          rel="stylesheet">

    <link href="{{ URL::asset("css/template_includes/font-awesome.css") }}" rel="stylesheet">
    <link href="{{ URL::asset("css/template_includes/style.css") }}" rel="stylesheet">
    <link href="{{ URL::asset("css/template_includes/signin.css") }}" rel="stylesheet">


</head>

<body>

<div class="navbar navbar-fixed-top">

    <div class="navbar-inner">

        <div class="container">

            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <a class="brand" href="index.html">
                Gitas API
            </a>

            <div class="nav-collapse">
                <ul class="nav pull-right">

                </ul>

            </div><!--/.nav-collapse -->

        </div> <!-- /container -->

    </div> <!-- /navbar-inner -->

</div> <!-- /navbar -->



<div class="account-container">

    <div class="content clearfix">

        <div id="app">
            <login-form></login-form>
        </div>


    </div> <!-- /content -->

</div> <!-- /account-container -->



<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ URL::asset("js/template_includes/base.js") }}"></script>

</body>

</html>
