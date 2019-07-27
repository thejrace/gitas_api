@php $page['users'] = true;  @endphp
@include('header')
<div class="main">
    <div class="main-inner">
        <div class="container">
            <div id="app">
                <div class="row">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-header">
                                <i class="icon-lock"></i>
                                <h3>'{{ request()->route()->parameter('user')->name }}' İzinler</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">
                                <user-permissions-vuetable model_id="{{ request()->route()->parameter('user')->id }}"></user-permissions-vuetable>
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
                                <i class="icon-lock"></i>
                                <h3>'{{ request()->route()->parameter('user')->name }}' İzin Ekle</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">
                                <add-user-permissions-vuetable model_id="{{ request()->route()->parameter('user')->id }}"></add-user-permissions-vuetable>
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