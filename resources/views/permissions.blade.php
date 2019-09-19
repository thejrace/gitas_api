@extends('includes.app')

@section('content')

    <permissions-page create-url="{{route('permissions.store', $permission_type )}}" permission-type="{{ $permission_type }}" ></permissions-page>

@endsection