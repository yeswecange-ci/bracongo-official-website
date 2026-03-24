@extends('layout.app')

@section('title', $boisson->nom)

@section('content')
@include('marques.partials.boisson-detail')
@endsection
