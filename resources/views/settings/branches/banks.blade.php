@extends('layouts.app')

@section('content')
  <h1>Branches <small><a href="branches/create" class="btn btn-secondary"><i class="fas fa-plus"></i></a></small></h1>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="{{ url()->previous() }}">{{$location->city}}</a></li>
      <li class="breadcrumb-item active">Choose Bank</li>
    </ol>
  </nav>
  <h2>Choose Bank</h2>
  @if(count($banks) > 0)
      @foreach ($banks as $bank)
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 col-sm-4">
                  <img style="width: 100%" src="/storage/cover_images/{{$bank->cover_image}}">
              </div>
              <div class="col-md-8 col-sm-8">
                <h3><a href="/settings/branches/locations/{{$location->location_id}}/banks/{{$bank->bank_id}}">{{$bank->fullname}}</a></h3>
                <p>{!!$bank->body!!}</p>
              </div>                  
          </div>
        </div>
    @endforeach        
      {{$banks->links()}}
  @else
      <p>No Location Found</p>
  @endif
@endsection