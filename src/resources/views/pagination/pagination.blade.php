@extends('layoutBase')

@section('menu')
    @include('mobileSideNav')
@endsection

@section('bodyLeft')
    @include('pagination.paginationLayout')
@endsection
