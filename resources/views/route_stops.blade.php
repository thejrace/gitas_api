@extends('includes.app')

@section('content')

    <route-stops-page parent-id="{{ $parentId ?? null }}" ></route-stops-page>

@endsection