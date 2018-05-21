@extends('layouts.app')

@section('content')
  <div class="jumbotron text-center">
    <h1>{{$title}}</h1>
    <p>This Application can provide information with regards to the status of every bank in Bacolod City.</p>
    @guest
      <p><a href="/login" class="btn btn-primary btn-lg" role="button">Login</a></p>
    @endguest
  </div>
  <div class="d-flex justify-content-center">
    <div class="card text-center" style="width:500px">
      <div class="card-body">
        @if (count($banks) > 0)
          <h4><div class="badge badge-info">Available Banks</div></h4>
          <div class="d-flex flex-row flex-wrap justify-content-center">
            @foreach ($banks as $bank)
              <div class="p-2"><img style="height:50px" class="img-thumbnail rounded" src="/storage/cover_images/{{$bank->cover_image}}"></div>
            @endforeach
          </div>    
        @endif    
      </div>
    </div>
  </div>
@endsection
