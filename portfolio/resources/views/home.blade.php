@extends('layout.app')

@section('title','Home')

@section('content')

@include('component.homebanner')

@include('component.homeservice')

@include('component.homeproject')

@include('component.homeContact')

@endsection