@extends('layouts.app')

@section('content')
  <h1><img style="width: 75px;" src="/storage/cover_images/{{$bank->cover_image}}">
  @if (!Auth::guest())   
    <small><a href="{{ route('branches.create', [$location->location_id, $bank->bank_id]) }}" class="btn btn-secondary" data-toggle="modal" data-target="#addBranch"><i class="fas fa-plus"></i></a></small>
  @endif
  </h1>  
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="/branches">{{$location->city}}</a></li>
      <li class="breadcrumb-item" aria-current="page"><a href="/branches/locations/{{$location->location_id}}">{{$bank->shortname}}</a></li>
      <li class="breadcrumb-item active">Branches</li>
    </ol>
  </nav>
  @if(count($branches) > 0)
        <table class="table table-striped table-small">
          <thead>
            <th width="5%">Status</th>
            <th width="15%">Branch</th>
            <th width="20%">Address</th>
            <th width="15%">Contact #</th>
            @if (!Auth::guest())   
            <th width="20%"><i class="fas fa-cog fa-spin"></i></th>
            @endif
          </thead>
          <tbody>
            @foreach ($branches as $branch)
              <tr>
              @if ($branch->status=='0')
              <td class="table-info align-middle">
              @elseif ($branch->status=='1') 
              <td class="table-success align-middle">
              @elseif ($branch->status=='2')
              <td class="table-danger align-middle">
              @elseif ($branch->status=='3')
              <td class="table-danger align-middle">     
              @endif         
                @if ($branch->status == '1')<div class="badge badge-success"><span style="font-weight: bold; font-size: 1.2em">Online</span></div> @elseif ($branch->status == '0') <div class="badge badge-info"><span style="font-weight: bold; font-size: 1.2em">Offline</span></div> @elseif ($branch->status == '2') <div class="badge badge-danger"><span style="font-weight: bold; font-size: 1.2em">Server Down</span></div> @elseif ($branch->status == '3')<div class="badge badge-danger"><span style="font-weight: bold; font-size: 1.2em">Closed</span></div>@endif</td>
                <td class="align-middle"><span style="font-weight: bold; font-size: 1.2em">{{$branch->branch_name}}</span></td>
                @if (!Auth::guest())
                  <td><small>{{$branch->address}}</small></td>
                @else
                  <td>{{$branch->address}}</td>
                @endif
                <td>{{$branch->contactnum}}</td>
            @if (!Auth::guest())   
                <td>
                  <div class="btn-group dropleft">
                    <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-server"></i>
                    </a>
                    <div class="dropdown-menu">
                      <a href="/branches/status/1/branch/{{$branch->branch_id}}" class="dropdown-item"><div class="badge badge-success">Online</div></a>
                      <a href="/branches/status/0/branch/{{$branch->branch_id}}" class="dropdown-item"><div class="badge badge-info">Offline</div></a>
                      <a href="/branches/status/2/branch/{{$branch->branch_id}}" class="dropdown-item"><div class="badge badge-danger">Server Down</div></a>
                      <a href="/branches/status/3/branch/{{$branch->branch_id}}" class="dropdown-item"><div class="badge badge-danger">Closed</div></a>
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
                        <div class="form-group">
                          {{Form::label('contactnum','Contact Number')}}
                          {{Form::text('contactnum',$branch->contactnum, ['class'=>'form-control','placeholder'=>'(Area code)+Contact Number'])}}
                          <span style="color:red;">X</span> If more than 1 Contact Number. Seperate it with a semi-colon.
                            @if ($errors->has('contactnum'))
                                <span class="badge badge-warning">
                                    <strong>{{ $errors->first('contactnum') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                          {{Form::label('address','Address')}}
                          {{Form::textarea('address',$branch->address, ['class'=>'form-control','placeholder'=>'Address'])}}
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