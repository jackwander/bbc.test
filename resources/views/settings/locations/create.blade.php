@extends('layouts.app')

@section('content')
  <h1>New Location</h1>
  {!! Form::open(['action' => 'LocationsController@store','method' => 'POST','enctype'=>'multipart/form-data']) !!}
      <div class="form-group">
        {{Form::label('city','City')}}
        {{Form::text('city','', ['class'=>'form-control','placeholder'=>'City'])}}
      </div>
      <div class="form-group">
        {{Form::label('shortname','Short Name')}}
        {{Form::text('shortname','', ['class'=>'form-control','placeholder'=>'Short Name'])}}
      </div>
      <div class="form-group">
        {{Form::file('cover_image')}}
      </div>
      {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
  {!! Form::close() !!}
@endsection