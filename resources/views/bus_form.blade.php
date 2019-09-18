@extends('includes.app')

@section('content')

    <bus-form-page data-id="{{ $dataId ?? null }}" ></bus-form-page>

@endsection