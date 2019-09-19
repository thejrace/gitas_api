@extends('includes.app')

@section('content')

    <user-form-page data-id="{{ $dataId ?? null }}" ></user-form-page>

@endsection