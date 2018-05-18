@extends('layouts.app')

@section('content')
  <h1>New Bank</h1>
  {!! Form::open(['action' => 'BanksController@store','method' => 'POST']) !!}
      <div class="form-group">
        {{Form::label('fullname','Bank full name')}}
        {{Form::text('fullname','', ['class'=>'form-control','placeholder'=>'Bank Full Name'])}}
      </div>
      <div class="form-group">
        {{Form::label('shortname','Bank Short Name')}}
        {{Form::text('shortname','', ['class'=>'form-control','placeholder'=>'Bank Short Name'])}}
      </div>
      {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
  {!! Form::close() !!}
@endsection