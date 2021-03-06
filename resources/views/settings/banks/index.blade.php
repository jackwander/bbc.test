@extends('layouts.app')

@section('content')
  <h1>Banks <small><a href="banks/create" class="btn btn-secondary"><i class="fas fa-plus"></i></a></small></h1>
  @if(count($banks) > 0)
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <th width="50%">Banks</th>
                <th width="50%"><i class="fas fa-cog fa-spin"></i></th>
              </thead>
              <tbody>
                @foreach ($banks as $bank)
                  <tr>
                    <td>
                      <center>
                        <img style="width: 75%" class="img-thumbnail rounded" src="/storage/cover_images/{{$bank->cover_image}}" >
                        <hr>                    
                        <h5>{{$bank->fullname}} (<b>{{$bank->shortname}}</b>)</h5>
                      </center>
                    </td>
                    <td class="align-middle align-center">
                      <a href="banks/{{$bank->bank_id}}/edit" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                      <br/>
                      <br/>
                      <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteBank{{$bank->bank_id}}"><i class="fas fa-trash"></i> Delete</a>
                      <div class="modal fade" id="deleteBank{{$bank->bank_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete <b>{{$bank->fullname}}</b></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Are you sure to delete <b>{{$bank->fullname}}</b>? When you click <b>Yes</b> there is no turning back.
                            </div>
                            <div class="modal-footer">
                                {!!Form::open(['action'=>['BanksController@destroy',$bank->bank_id],'method'=>'POST'])!!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Yes',['class'=>'btn btn-danger'])}}
                                {!!Form::close()!!}
                            </div>
                          </div>
                        </div>
                      </div>                  
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
      {{$banks->links()}}
  @else
      <p>No Banks Found</p>
  @endif
@endsection