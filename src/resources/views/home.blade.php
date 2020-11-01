@extends('layoutBase')

@section('menu')
    @include('mobileSideNav')
@endsection

@section('header')
    @include('temphum')
@endsection

@section('bodyLeft')
    @include('heater.quickSetLayout')
@endsection

@section('bodyRight')
    @include('hue.quickSetLayout')
@endsection

@section('bodyLeftLower')
    @include('door.quickSetLayout')
@endsection 
