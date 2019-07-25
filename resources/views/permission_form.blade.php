@php $page['permissions'] = true;  @endphp
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
                                <h3><i>{{ request()->route()->parameter('permission_type')->name }}</i> - İzin Formu</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">
                                <permission-form data-id="{{ $dataId ?? null }}" parent-id="{{ request()->route()->parameter('permission_type')->id }}" permission-prefix="@php if(isset($_GET['permission_prefix'])) echo $_GET["permission_prefix"] @endphp"></permission-form>
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