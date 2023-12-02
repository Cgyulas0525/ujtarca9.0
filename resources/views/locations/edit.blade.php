@extends('layouts.app')

@section('content')
    @include('layouts.edit', ['title' => $location->name, 'model' => 'locations', 'record' => $location])
@endsection
