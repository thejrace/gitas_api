@extends('includes.app')

@section('content')

    <permission-type-form-page data-id="{{ $dataId ?? null }}" ></permission-type-form-page>

@endsection