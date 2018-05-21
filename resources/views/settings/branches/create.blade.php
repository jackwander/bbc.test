        <h5>Add Branch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {!! Form::open(['action' => 'BranchesController@store','method' => 'POST']) !!}
              {{Form::hidden('location_id',$location->location_id)}}
              {{Form::hidden('bank_id',$bank->bank_id)}}
            <div class="form-group">
              {{Form::label('branch','Branch')}}
              {{Form::text('branch','', ['class'=>'form-control','placeholder'=>'Branch'])}}
            </div>
            <div class="form-group">
              {{Form::label('contactnum','Contact Number')}}
              {{Form::text('contactnum','', ['class'=>'form-control','placeholder'=>'(Area code)+Contact Number'])}}
              <span style="color:red;">X</span> If more than 1 Contact Number. Seperate it with a semi-colon.
                @if ($errors->has('contactnum'))
                    <span class="badge badge-warning">
                        <strong>{{ $errors->first('contactnum') }}</strong>
                    </span>
                @endif        

            </div>
            <div class="form-group">
              {{Form::label('address','Address')}}
              {{Form::textarea('address','', ['class'=>'form-control','placeholder'=>'Address'])}}
            </div>                  
              
              <div class="modal fade" id="submitForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <center><p><h5>Are you sure to submit this?</h5></p></center>
                    </div>
                    <div class="modal-footer">
                      {{Form::submit('Yes',['class'=>'btn btn-primary'])}}
                    </div>
                  </div>
                </div>
              </div>        
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#submitForm">Submit</a>
        {!! Form::close() !!}
