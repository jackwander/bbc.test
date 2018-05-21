@extends('layouts.app')

@section('content')
  <a href="/settings/locations" class="btn btn-outline-secondary">Go Back</a>
  <div class="d-flex justify-content-center">
    <img style="width:50%;height:50%" class="img-thumbnail rounded" src="/storage/cover_images/{{$location->cover_image}}">
  </div>
  <div class="d-flex justify-content-center">
    <h1>{{$location->city}} ({{$location->shortname}})</h1>
  </div>
    <p>{!!$location->body!!}</p>
  <hr>
  @if (!Auth::guest())
    {{-- @if (Auth::user()->id == $location->user_id) --}}
      <a href="/settings/locations/{{$location->location_id}}/edit" class="btn btn-secondary">Edit</a>
      <a href="#" class="btn btn-danger float-right" data-toggle="modal" data-target="#deleteLocation">Delete</a>
    {{-- @endif --}}
  @endif
@endsection
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="deleteLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to delete <b>{{$location->city}}</b>?
      </div>
      <div class="modal-footer">
          {!!Form::open(['action'=>['LocationsController@destroy',$location->location_id],'method'=>'POST','onclick'=>'return confirm("When click yes there is no turning back.")'])!!}
          {{Form::hidden('_method','DELETE')}}
          {{Form::submit('Yes',['class'=>'btn btn-danger'])}}
          {!!Form::close()!!}
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
      </div>
    </div>
  </div>
</div>