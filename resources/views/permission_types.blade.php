@extends('includes.app')

@section('content')

    <permission-types-page create-url="{{ route('permission_types.form') }}" ></permission-types-page>

@endsection