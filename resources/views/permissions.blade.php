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
                                <i class="icon-user"></i>
                                <h3><i>{{ request()->route()->parameter('permission_type')->name }}</i> - İzin Listesi</h3>
                            </div> <!-- /widget-header -->

                            <permission-types-select selected-id="3"></permission-types-select>

                            <div class="widget-content">
                                <div class="top-nav-container">
                                    <a href="{{route('permissions.store', $permission_type )}}"><button type="button" class="ui basic button"><i class="icon-plus"></i></button></a>
                                </div>
                                <permissions-vuetable permission-type="{{ $permission_type }}" ></permissions-vuetable>
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