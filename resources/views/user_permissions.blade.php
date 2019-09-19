@extends('includes.app')

@section('content')

    <div class="widget">
        <div class="widget-header">
            <i class="icon-lock"></i>
            <h3>'{{ request()->route()->parameter('user')->name }}' İzin Ekle</h3>
        </div> <!-- /widget-header -->

        <div class="widget-content">
            <add-user-permissions-vuetable model_id="{{ request()->route()->parameter('user')->id }}"></add-user-permissions-vuetable>
        </div>
    </div>

    <div class="widget">
        <div class="widget-header">
            <i class="icon-lock"></i>
            <h3>'{{ request()->route()->parameter('user')->name }}' İzinler</h3>
        </div> <!-- /widget-header -->

        <div class="widget-content">
            <user-permissions-vuetable model_id="{{ request()->route()->parameter('user')->id }}"></user-permissions-vuetable>
        </div>
    </div>

@endsection