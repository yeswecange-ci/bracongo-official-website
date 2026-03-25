@extends('layout.app')

@section('title', $page->titreOnglet())

@section('content')
@include('marques.partials.liste-boissons-hero-et-grille', ['page' => $page, 'toutesBoissons' => $toutesBoissons])
@endsection
