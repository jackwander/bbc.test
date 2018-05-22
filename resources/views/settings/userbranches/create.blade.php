@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Assign Personnel') }}</div>

        <div class="card-body">

            {!! Form::open(['action' => 'UserBranchesController@assignBranch','method' => 'POST','class'=>'px-4 py-3']) !!}
              @csrf
                
                {{Form::label('bank','Bank')}}
                <div class="form-group">
                  <select id="banks" class="form-control select" name="bank_id">
                    <option selected="true" disabled="true">Choose Bank</option>
                      @foreach ($banks as $bank)
                       <option value="{{$bank->bank_id}}">{{$bank->fullname}}</option>
                      @endforeach
                  </select>
                </div>     

                {{Form::label('location','Location')}}
                <div class="form-group">
                  <select id="locations" class="form-control select" name="location_id">
                    <option selected="true" disabled="true">Choose Location</option>
                      @foreach ($locations as $location)
                       <option value="{{$location->location_id}}">{{$location->city}}</option>
                      @endforeach
                  </select>
                </div>

                {{Form::label('branches','Branches')}}
                <div class="form-group">
                  <select id="branches" class="form-control select" name="branch_id">
                    <option selected="true" disabled="true"></option>
                  </select>
                </div>

                {{Form::label('personnel','Personnel')}}
                <div class="form-group">
                  <select id="users" class="form-control select" name="user_id">
                    <option selected="true" disabled="true"></option>
                  </select>
                </div>                
            <div class="card-footer">
              {{Form::submit('Assign',['class'=>'btn btn-primary'])}}
            </div>
              {!! Form::close() !!}
          </div>
            
      </div>
    </div>
  </div>
</div>

@endsection