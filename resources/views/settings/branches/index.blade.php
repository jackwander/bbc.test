@extends('layouts.app')

@section('content')
  <h2>Location</h2>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Choose Location</li>
    </ol>
  </nav>
  @if(count($locations) > 0)
    @foreach ($locations as $location)
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 col-sm-4">
                  <img style="width: 100%" class="img-thumbnail rounded" src="/storage/cover_images/{{$location->cover_image}}">
              </div>
              <div class="col-md-8 col-sm-8">
                <h3><a href="/branches/locations/{{$location->location_id}}">{{$location->city}}</a></h3>
                <p>{!!$location->body!!}</p>
              </div>                  
          </div>
        </div>
    @endforeach
      {{$locations->links()}}
  @else
      <p>No Location Found</p>
  @endif
@endsection