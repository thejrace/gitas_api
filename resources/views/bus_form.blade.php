@php $page['buses'] = true;  @endphp
@include('header')
<div class="main">
    <div class="main-inner">
        <div class="container">
            <div id="app">
                <div class="row">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-header">
                                <i class="icon-truck"></i>
                                <h3>Bus Form</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">

                            @if(isset($updateFlag))
                                <bus-form data-id="{{ $dataId }}" update-flag></bus-form>
                            @else
                                <bus-form></bus-form>
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