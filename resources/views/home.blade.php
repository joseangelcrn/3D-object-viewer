@extends('layouts.app')

@section('content')
    <home :user="{{$user}}" :models="{{$models}}"></home>
@endsection
