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
                                <i class="icon-lock"></i>
                                <h3>Permission Form</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">

                            @if(isset($updateFlag))
                                <permission-form data-id="{{ $dataId }}" update-flag></permission-form>
                            @else
                                <permission-form permission-prefix="@php if(isset($_GET['permission_prefix'])) echo $_GET["permission_prefix"] @endphp" ></permission-form>
                            @endif

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