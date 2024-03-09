@extends('app-scaffold.html.app')

@section('content')
    @include('layouts.create', ['title' => 'Kiszállítási cím', 'model' => 'locations'])
@endsection

