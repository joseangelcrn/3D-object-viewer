@extends('layouts.app')

@section('content')
    <home :user="{{$user}}"></home>
@endsection
