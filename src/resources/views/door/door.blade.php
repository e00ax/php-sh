@extends('layoutBase')

@section('menu')
    @include('mobileSideNav')
@endsection

@section('bodyLeft')
    @include('door.doorLayout')
@endsection
