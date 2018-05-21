@extends('layouts.app')

@section('content')
  <div class="jumbotron text-center">
    <h1>{{$title}}</h1>
    <p>This Application can provide information with regards to the status of every bank in Bacolod City.</p>
    @guest
      <p><a href="/login" class="btn btn-primary btn-lg" role="button">Login</a></p>
    @endguest
  </div>
@endsection
