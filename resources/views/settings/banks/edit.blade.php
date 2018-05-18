@extends('layouts.app')

@section('content')
  <h1>Edit Bank</h1>
  {!! Form::open(['action' => ['BanksController@update', $bank->bank_id],'method' => 'POST']) !!}
      <div class="form-group">
        {{Form::label('fullname','Bank full name')}}
        {{Form::text('fullname',$bank->fullname, ['class'=>'form-control','placeholder'=>'Bank Full Name'])}}
      </div>
      <div class="form-group">
        {{Form::label('shortname','Bank Short Name')}}
        {{Form::text('shortname',$bank->shortname, ['class'=>'form-control','placeholder'=>'Bank Short Name'])}}
      </div>      
      {{Form::hidden('_method','PUT')}}
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#submitForm">Submit</a>
        
        <div class="modal fade" id="submitForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="alert alert-primary" role="alert">
                  <h4 class="alert-heading">Attention!</h4>
                  <p>Are you sure to submit this?</p>
                </div>
              </div>
              <div class="modal-footer">
                {{Form::submit('Yes',['class'=>'btn btn-primary'])}}
              </div>
            </div>
          </div>
        </div> 
  {!! Form::close() !!}
@endsection