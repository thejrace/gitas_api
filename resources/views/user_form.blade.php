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
                                <i class="icon-user"></i>
                                <h3>User Form</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">

                            @if(isset($updateFlag))
                                <user-form data-id="{{ $dataId }}" update-flag></user-form>
                            @else
                                <user-form></user-form>
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