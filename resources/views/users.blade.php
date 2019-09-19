@extends('includes.app')

@section('content')

    <users-page create-url="{{ route('users.form')  }}" ></users-page>

@endsection