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
                                <h3>İzin Tipi Formu</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">
                                <permission-type-form data-id="{{ $dataId ?? null }}"></permission-type-form>
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