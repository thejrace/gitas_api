@php $page['routeScanners'] = true;  @endphp
@include('includes.header')
<div class="main">
    <div class="main-inner">
        <div class="container" id="app">
            <div class="row">
                <div class="span12">


                    <div class="widget">
                        <div class="widget-header"> <i class="icon-compass"></i>
                            <h3> {{ $routeCode }} Önizleme</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">

                            <kahya route-code="{{ $routeCode ?? null }}" ></kahya>

                        </div>
                        <!-- /widget-content -->
                    </div>
                    <!-- /widget -->
                </div>
                <!-- /span6 -->

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /main-inner -->
</div>
@include('includes.footer')