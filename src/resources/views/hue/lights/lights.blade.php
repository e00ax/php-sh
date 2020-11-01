@extends('layoutBase')

@section('menu')
    @include('mobileSideNav')
@endsection

@section('bodyLeft')
    @include('hue.lights.lightsLayout')
@endsection
