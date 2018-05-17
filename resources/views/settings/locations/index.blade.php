@extends('layouts.app')

@section('content')
  <h1>Locations</h1>
  @if(count($locations) > 0)
      @foreach ($locations as $location)
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 col-sm-4">
                <img style="width: 100%" src="/storage/cover_images/{{$location->cover_image}}">
              </div>
              <div class="col-md-8 col-sm-8">
                <h3><a href="/settings/locations/{{$location->location_id}}">{{$location->city}}</a></h3>
                <small>Added on {{$location->created_at}}</small>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      {{$locations->links()}}
  @else
      <p>No Locations Found</p>
  @endif
@endsection