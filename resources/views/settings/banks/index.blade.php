@extends('layouts.app')

@section('content')
  <h1>Banks</h1>
  @if(count($banks) > 0)
      @foreach ($banks as $bank)
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 col-sm-4">
                {{-- <img style="width: 100%" src="/storage/cover_images/{{$bank->cover_image}}"> --}}
              </div>
              <div class="col-md-8 col-sm-8">
                <h3><a href="/settings/banks/{{$bank->bank_id}}">{{$bank->name}}</a></h3>
                <small>Added on {{$bank->created_at}}</small>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      {{$banks->links()}}
  @else
      <p>No Locations Found</p>
  @endif
@endsection