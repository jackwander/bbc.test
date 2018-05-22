@extends('layouts.app')

@section('content')
  <div class="jumbotron text-center">
    <h1>{{$title}}</h1>
    <p>This <b>Web Application</b> can provide <b>information</b> with regards to the status of every bank in <b>Negros Island</b>.</p>
    <p><a href="/branches" class="btn btn-success btn-lg" role="button"><i class="fas fa-search"></i> Find Your Bank</a></p>
  </div>
 
  <div class="d-flex justify-content-center">
    <div class="card text-center">
      <div class="card-body">
        @if (count($banks) > 0)
          <h1><div class="badge badge-dark">Available Banks</div></h1>
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
