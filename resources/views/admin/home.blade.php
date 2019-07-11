@extends('layouts.admin')


@section('content')
   
    @if (isset($dispo))
        @include('layouts.produits.liste')
    @endif

    @if (isset($indispo))
        @include('layouts.produits.liste')
    @endif

    @if (isset($cmd))
        @include('layouts.produits.liste')
    @endif
    

@endsection