@extends('layoutBase')

@section('menu')
    @include('mobileSideNav')
@endsection

@section('bodyLeft')
    @include('hue.sensors.sensorsLayout')
@endsection
