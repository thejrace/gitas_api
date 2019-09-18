@extends('includes.app')

@section('content')

    <service-settings-page data-id="{{ $dataId ?? null }}"></service-settings-page>

@endsection