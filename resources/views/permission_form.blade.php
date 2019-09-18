@extends('includes.app')

@section('content')

    <permission-form-page data-id="{{ $dataId ?? null }}" type-id="{{ request()->route()->parameter('permission_type')->id }}" ></permission-form-page>

@endsection