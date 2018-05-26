@extends('layouts.app')

@section('content')
<div class="container">
<div class="card">
  <h1 class="card-header text-center">Profile</h1>
{{--   {{ Form::open(array('url' => 'admin/doctor/edit/'.$user->id,'method' => 'POST')) }} --}}
    {!! Form::open(['action' => ['UsersController@update', $user->id],'method' => 'POST','enctype'=>'multipart/form-data']) !!}
  <input type="hidden" name="_method" value="PUT">
  <input type="hidden" name="id" value="{{$user->id}}">  
  <div class="card-body">
    <div class="d-flex flex-flow justify-content-center">
        <div class="card m-1" style="width: 20rem;">
          <h4 class="card-header">Image and Login Security</h4>
          <img class="card-img-top" src="/storage/cover_images/{{$user->cover_image}}" alt="Card image cap">
          <div class="card-body">
            {{-- <div class="mb-2">
            <small class="text-muted">Image</small>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-file-image"></i></div>
                </div>
                <input type="file" class="form-contro{{ $errors->has('cover_image') ? ' is-invalid' : '' }}l" name="cover_image" id="inlineFormInputGroup">
                  @if ($errors->has('cover_image'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('cover_image') }}</strong>
                      </span>
                  @endif                
              </div>              
            </div> --}}
            <div class="mb-2">
            <small class="text-muted">Email</small>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-at"></i></div>
                </div>
                <input type="text" class="form-control" id="inlineFormInputGroup" value="{{$user->email}}" readonly="">
              </div>
            </div>
{{--             <div class="mb-2">
              <small for="password" class="text-muted">{{ __('Password') }}</small>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-lock"></i></div>
                </div>
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                  @if ($errors->has('password'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif                               
              </div>              
            </div> 
            <div class="mb-2">
              <small for="password" class="text-muted">{{ __('Confirm Password') }}</small>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-lock"></i></div>
                </div>
               <input id="password-confirm" type="password" class="form-control" name="password_confirmation">                              
              </div>
            </div>   --}}
          </div>
        </div>

        <div class="card m-1" style="width: 20rem;">
          <h4 class="card-header">Personal Information</h4>
          <div class=card-body>
            <div class="mb-2">
              <div class="form-group">
                <small class="text-muted">First Name</small>
                <input type="text" name="fname" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" value="{{$user->fname}}" required="">
                @if ($errors->has('fname'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('fname') }}</strong>
                    </span>
                @endif                 
              </div>
              <div class="form-group">
                <small class="text-muted">Middle Name</small>
                <input type="text" name="mname" class="form-control{{ $errors->has('mname') ? ' is-invalid' : '' }}" value="{{$user->mname}}" required="">
                  @if ($errors->has('mname'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('mname') }}</strong>
                      </span>
                  @endif                 
              </div>
              <div class="form-group">
                <small class="text-muted">Last Name</small>
                <input type="text" name="lname" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" value="{{$user->lname}}" required="">
                  @if ($errors->has('lname'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('lname') }}</strong>
                      </span>
                  @endif                 
              </div>            
            </div>
            <div class="mb-2">
            <small class="text-muted">Contact Number</small>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-phone"></i></div>
                </div>
                <input type="text" name="contactnum" class="form-control{{ $errors->has('contactnum') ? ' is-invalid' : '' }}" id="inlineFormInputGroup" value="{{$user->contactnum}}">
                  @if ($errors->has('contactnum'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('contactnum') }}</strong>
                      </span>
                  @endif                 
              </div>          
            </div>
            <div class="mb-2">
            <small class="text-muted">Address</small>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-map-marker"></i></div>
                </div>
                <select id="address" name="address" required="" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">
                  <option selected="" value="{{$user->location_id}}">{{DB::table('locations')->where('location_id',$user->location_id)->value('city')}}</option>
                  @foreach ($locations as $location)
                    <option value="{{$location->location_id}}">{{$location->city}}</option>
                  @endforeach
                </select>
<script type="text/javascript">
      $(document).ready(function(){
        $('#address').select2();
      });
</script>                
                  @if ($errors->has('address'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('address') }}</strong>
                      </span>
                  @endif                 
              </div>          
            </div>              
            <div class="mb-2">
              <small class="text-muted">Position</small>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user-circle"></i></div>
                </div>
                <input type="text" class="form-control" id="inlineFormInputGroup" value="@if ($user->position>0) Bank Personnel @else Admin @endif" readonly="true">
              </div>
            </div>      
            <div class="mb-2">
              <small class="text-muted"># of Branch handled</small>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-code-branch"></i></div>
                </div>
                <input type="text" class="form-control" id="inlineFormInputGroup" value="
                    {{$assignedB.' Branch'}}
                  " readonly="">
              </div>
            </div>
          </div>      
        </div>     
    </div>    
  </div>
  <div class="card-footer d-flex justify-content-center">
    <input type="submit" name="submit" value="Save" class="btn btn-primary" style="width:20rem">
  </div>
  </form>
</div>
</div> 
@endsection
