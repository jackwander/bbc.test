@extends('layouts.app')

@section('content')
<div class="container">
<div class="card">
  <h1 class="card-header text-center">Profile</h1>
  <div class="card-body">
    <div class="d-flex flex-flow justify-content-center">
        <div class="card m-5" style="width: 20rem;">
          <img class="card-img-top" src="/storage/cover_images/blankpp.jpg" alt="Card image cap">
          <div class="card-body text-center">
            <p class="card-text"><h1>{{$user->fname.' '.$user->mname.' '.$user->lname}}</h1></p>
          </div>
        </div>  

        <div class="card m-5" style="width: 20rem;">
          <h4 class="card-header">Personal Information</h4>
          <div class=card-body>
            <div class="mb-3">
            <small class="text-muted">Email</small>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-at"></i></div>
                </div>
                <input type="text" class="form-control" id="inlineFormInputGroup" value="{{$user->email}}" readonly="">
              </div>
            </div>  
            <div class="mb-3">
            <small class="text-muted">Contact Number</small>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-phone"></i></div>
                </div>
                <input type="text" class="form-control" id="inlineFormInputGroup" value="{{$user->email}}" readonly="">
              </div>          
            </div>              
            <div class="mb-3">
              <small class="text-muted">Position</small>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user-circle"></i></div>
                </div>
                <input type="text" class="form-control" id="inlineFormInputGroup" value="@if ($user->position>0) Bank Personnel @endif" readonly="">
              </div>
            </div>      
            <div class="mb-3">
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
          <div class="card-footer">
            <div class="float-left">
              <a href="/settings/users/{{$user->id}}/edit" class="btn btn-warning"><i class="fas fa-user-edit"></i> Edit</a>
            </div>
            <div class="float-right">
             @if (Auth::user()->position==0)
              <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteUser{{$user->id}}"><i class="fas fa-trash"></i> Delete</a>
              <div class="modal fade" id="deleteUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete <b>{{$user->fname.' '.$user->lname}}</b></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are you sure to delete <b>{{$user->fname.' '.$user->lname}}</b>? When you <b>PROCEED</b>, all assigned branch to the personnel will also be deleted.
                    </div>
                    <div class="modal-footer">
                        {!!Form::open(['action'=>['UsersController@destroy',$user->id],'method'=>'POST'])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Yes',['class'=>'btn btn-danger'])}}
                        {!!Form::close()!!}
                    </div>
                  </div>
                </div>
              </div>
             @endif
            
            </div>
          </div>
        </div>
    </div>    
  </div>
</div>
</div> 
@endsection
