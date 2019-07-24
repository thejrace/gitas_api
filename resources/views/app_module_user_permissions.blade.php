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
                                <h3>'{{ request()->route()->parameter('app_module_user')->name }}' Kullanıcı İzinleri</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">
                                <app-module-user-permissions-vuetable model_id="{{ request()->route()->parameter('app_module_user')->id }}" ></app-module-user-permissions-vuetable>
                            </div>
                        </div>
                    </div>
                    <!-- /span6 -->
                </div>
                <!-- /row -->

                <div class="row">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-header">
                                <i class="icon-key"></i>
                                <h3>'{{ request()->route()->parameter('app_module_user')->name }}' İzin Ekle</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">

                                <app-module-permissions-vuetable model_id="{{ request()->route()->parameter('app_module_user')->id }}"></app-module-permissions-vuetable>
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