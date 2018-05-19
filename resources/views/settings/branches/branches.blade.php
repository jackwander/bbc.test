@extends('layouts.app')

@section('content')
  <h1>Branches 
  @if (!Auth::guest())   
    <small><a href="{{ route('settings.branches.create', [$location->location_id, $bank->bank_id]) }}" class="btn btn-secondary" data-toggle="modal" data-target="#addBranch"><i class="fas fa-plus"></i></a></small>
  @endif
  </h1>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="/settings/branches">{{$location->city}}</a></li>
      <li class="breadcrumb-item" aria-current="page"><a href="{{ url()->previous() }}">{{$bank->shortname}}</a></li>
      <li class="breadcrumb-item active">Branches</li>
    </ol>
  </nav>
  @if(count($branches) > 0)
        <table class="table table-striped">
          <thead>
            <th>Branch</th>
            <th>Status</th>
            @if (!Auth::guest())   
            <th><i class="fas fa-cog fa-spin"></i></th>
            @endif
          </thead>
          <tbody>
            @foreach ($branches as $branch)
              <tr>
                <td>{{$branch->branch_name}}</td>
                <td>@if ($branch->status == '1')<div class="badge badge-success">Online</div> @elseif ($branch->status == '0') <div class="badge badge-info">Offline but Open</div> @elseif ($branch->status == '2') <div class="badge badge-danger">Server Down</div> @elseif ($branch->status == '3')<div class="badge badge-danger">Closed</div>@endif</td>
            @if (!Auth::guest())   
                <td>
                  <div class="btn-group dropleft">
                    <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-server"></i>
                    </a>
                    <div class="dropdown-menu">
                      <a href="/settings/branches/status/1/branch/{{$branch->branch_id}}" class="dropdown-item"><div class="badge badge-success">Online</div></a>
                      <a href="/settings/branches/status/0/branch/{{$branch->branch_id}}" class="dropdown-item"><div class="badge badge-info">Offline but open</div></a>
                      <a href="/settings/branches/status/2/branch/{{$branch->branch_id}}" class="dropdown-item"><div class="badge badge-danger">Server Down</div></a>
                      <a href="/settings/branches/status/3/branch/{{$branch->branch_id}}" class="dropdown-item"><div class="badge badge-danger">Closed</div></a>
                    </div>
                  </div>                
                  <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editBranch{{$branch->branch_id}}"><i class="fas fa-edit"></i></a>
            @if (!Auth::guest())                  
                  <!--Modal For Edit-->
                  <div class="modal fade" id="editBranch{{$branch->branch_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit {{$branch->branch_name}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                          {!! Form::open(['action' => ['BranchesController@update', $branch->branch_id],'method' => 'POST']) !!}
                          {{Form::hidden('_method','PUT')}}
                        <div class="modal-body">
                              <div class="form-group">
                                {{Form::label('branch','Branch')}}
                                {{Form::text('branch',$branch->branch_name, ['class'=>'form-control','placeholder'=>'Branch'])}}
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
                        </div>
                        <div class="modal-footer">
                          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#submitForm">Submit</a>
                          {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--End of Modal For Edit-->
                  @endif

                  @if (!Auth::guest())
                  <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteBranch{{$branch->branch_id}}"><i class="fas fa-trash"></i></a>
                  <!--Modal For Delete-->
                  <div class="modal fade" id="deleteBranch{{$branch->branch_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete <b>{{$branch->branch_name}}</b></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Are you sure to delete <b>{{$branch->branch_name}}</b>? When you click <b>Yes</b> there is no turning back.
                        </div>
                        <div class="modal-footer">
                            {!!Form::open(['action'=>['BranchesController@destroy',$branch->branch_id],'method'=>'POST'])!!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('Yes',['class'=>'btn btn-danger'])}}
                            {!!Form::close()!!}
                        </div>
                      </div>
                    </div>
                  </div>                  
                  <!--End of Modal For Delete-->
                  @endif
                </td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      {{$branches->links()}}
  @else
      <p>No Branches Found</p>
  @endif
@endsection

@if (!Auth::guest())
<!-- Modal -->
<div class="modal fade" id="addBranch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Branch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        {!! Form::open(['action' => 'BranchesController@store','method' => 'POST']) !!}
      <div class="modal-body">
              {{Form::hidden('location_id',$location->location_id)}}
              {{Form::hidden('bank_id',$bank->bank_id)}}
            <div class="form-group">
              {{Form::label('branch','Branch')}}
              {{Form::text('branch','', ['class'=>'form-control','placeholder'=>'Branch'])}}
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
      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#submitForm">Submit</a>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endif