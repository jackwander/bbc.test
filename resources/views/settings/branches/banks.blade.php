@extends('layouts.app')

@section('content')
  <h2>Choose Bank</h2>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="/branches">{{$location->city}}</a></li>
      <li class="breadcrumb-item active">Choose Bank</li>
    </ol>
  </nav>
  <div class="d-flex justify-content-center">
    <div class="card text-center">
      <div class="card-body">
        @if (count($banks) > 0)
          <div class="d-flex flex-row flex-wrap justify-content-center">
            @foreach ($banks as $bank)
              <div class="p-2">
                <a href="/branches/locations/{{$location->location_id}}/banks/{{$bank->bank_id}}">
                  <img style="height:50px" class="img-thumbnail rounded" src="/storage/cover_images/{{$bank->cover_image}}">
                  <p>{{$bank->fullname}}</p>
                </a>
              </div>
            @endforeach
          </div>
        @else
            <p>No Banks Found</p>
        @endif    
      </div>
    </div>
  </div>       
      {{-- {{$banks->links()}} --}}
@endsection