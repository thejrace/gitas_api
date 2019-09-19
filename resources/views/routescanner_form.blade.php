@extends('includes.app')

    @section('content')

        <route-scanner-form-page data-id="{{ $dataId ?? null }}" ></route-scanner-form-page>

    @endsection