@php $page['permissions'] = true;  @endphp
@include('header')
<div class="main">
    <div class="main-inner">
        <div class="container">
            <div id="app">
                <div class="row">
                    <div class="span12">

                        @isset($appModule)

                            <div class="widget">
                                <div class="widget-header">
                                    <i class="icon-lock"></i>
                                    <h3><i>{{ request()->route()->parameter('app_module')->name }}</i> - Modül İzin Formu</h3>
                                </div> <!-- /widget-header -->

                                <div class="widget-content">
                                    <permission-form data-id="{{ $dataId ?? null }}" app-module-id="{{ request()->route()->parameter('app_module')->id }}"></permission-form>
                                </div>
                            </div>

                        @else

                            <div class="widget">
                                <div class="widget-header">
                                    <i class="icon-lock"></i>
                                    <h3><i>{{ request()->route()->parameter('permission_type')->name }}</i> - İzin Formu</h3>
                                </div> <!-- /widget-header -->

                                <div class="widget-content">
                                    <permission-form data-id="{{ $dataId ?? null }}" type-id="{{ request()->route()->parameter('permission_type')->id }}" ></permission-form>
                                </div>
                            </div>

                        @endisset


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