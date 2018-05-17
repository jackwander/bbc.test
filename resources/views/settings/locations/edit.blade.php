@extends('layouts.app')

@section('content')
  <h1>Edit Location</h1>
  {!! Form::open(['action' => ['LocationsController@update', $location->location_id],'method' => 'POST','enctype'=>'multipart/form-data']) !!}
      <div class="form-group">
        {{Form::label('city','City')}}
        {{Form::text('city',$location->city, ['class'=>'form-control','placeholder'=>'City'])}}
      </div>
      <div class="form-group">
        {{Form::label('shortname','Short Name')}}
        {{Form::text('shortname',$location->shortname, ['class'=>'form-control','placeholder'=>'Short Name'])}}
      </div>
      <div class="form-group">
        {{Form::file('cover_image')}}
      </div>           
      {{Form::hidden('_method','PUT')}}
      {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
  {!! Form::close() !!}
@endsection