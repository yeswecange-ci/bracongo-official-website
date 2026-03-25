@extends('layout.app')

@section('title', $pageBieres->titreOnglet())

@section('content')
@include('marques.partials.liste-boissons-hero-et-grille', ['page' => $pageBieres, 'toutesBoissons' => $toutesBoissons])
@endsection
