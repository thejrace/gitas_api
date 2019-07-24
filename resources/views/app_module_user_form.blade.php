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
                                <h3>'{{ request()->route()->parameter('app_module')->name }}' Modül Kullanıcısı Ekle</h3>
                            </div> <!-- /widget-header -->
                            <div class="widget-content">
                                <app-module-user-form data-id="{{ $dataId ?? null }}"  parent-id="{{ request()->route()->parameter('app_module')->id }}"></app-module-user-form>
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