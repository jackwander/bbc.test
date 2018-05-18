@extends('layouts.app')

@section('content')
  <h1>Edit Bank</h1>
  {!! Form::open(['action' => ['BanksController@update', $bank->bank_id],'method' => 'POST','onsubmit'=>'return confirm("Are you sure to submit this?.")']) !!}
      <div class="form-group">
        {{Form::label('fullname','Bank full name')}}
        {{Form::text('fullname',$bank->fullname, ['class'=>'form-control','placeholder'=>'Bank Full Name'])}}
      </div>
      <div class="form-group">
        {{Form::label('shortname','Bank Short Name')}}
        {{Form::text('shortname',$bank->shortname, ['class'=>'form-control','placeholder'=>'Bank Short Name'])}}
      </div>      
      {{Form::hidden('_method','PUT')}}
      {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
  {!! Form::close() !!}
@endsection