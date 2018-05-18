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