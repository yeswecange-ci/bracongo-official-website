@extends('layout.app')

@section('title', $boisson->nom)

@section('content')
    @include('marques.beaufort')
@endsection
