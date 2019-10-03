@extends('includes.app')

@section('content')


    <user-buses-table user-id="{{ $userId }}" user-name="{{ $userName }}" type="defined" ></user-buses-table>


    <user-buses-table user-id="{{ $userId }}" user-name="{{ $userName }}" type="notDefined"></user-buses-table>

@endsection