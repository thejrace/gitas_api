@php $page['app_modules'] = true;  @endphp
@include('header')
<div class="main">
    <div class="main-inner">
        <div class="container">
            <div id="app">
                <div class="row">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-header">
                                <i class="icon-user"></i>
                                <h3>Users</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">
                                <div class="top-nav-container">
                                    <a href="{{route('app_module_users.form')}}"><button type="button" class="ui basic button"><i class="icon-plus"></i></button></a>
                                </div>
                                <app-module-users-vuetable  app_module_id="{{ request()->route()->parameter('app_module')->id }}"></app-module-users-vuetable>
                            </div>
                        </div>
                    </div>
                    <!-- /span6 -->
                </div>
                <!-- /row -->
            </div>
            <!-- /app -->
        </div>
        <!-- /container -->
    </div>
    <!-- /main-inner -->
</div>

@include('footer')