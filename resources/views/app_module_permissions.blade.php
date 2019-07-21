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
                                <i class="icon-key"></i>
                                <h3>{{ request()->route()->parameter('app_module')->name }} Permissions</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">
                                <div class="top-nav-container">
                                    <a href="{{route('permissions.form')}}/?permission_prefix={{ request()->route()->parameter('app_module')->permission_prefix }}."><button type="button" class="ui basic button"><i class="icon-plus"></i></button></a>
                                </div>
                                <app-module-permissions-vuetable app_module_id="{{ request()->route()->parameter('app_module')->id }}" ></app-module-permissions-vuetable>
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