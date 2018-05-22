@extends('layouts.app')

@section('content')
  
    <h1>Bank Personnel Branch Responsibilty <small><a href="userbranches/create" class="btn btn-secondary"><i class="fas fa-plus"></i></a></small></h1>
    @if (count($usb) > 0)
      <table class="table table-striped table-hover">
        <thead>
          <th>Name</th>
          <th>Location</th>
          <th>Branch</th>
          <th><i class="fas fa-cog fa-spin"></i></th>
        </thead>
        <tbody>
          @foreach ($usb as $us)
            <tr>
              <td>{{DB::table('users')->where(['id'=>$us->user_id])->value('fname').' '.DB::table('users')->where(['id'=>$us->user_id])->value('lname')}}</td>
              <td>{{DB::table('locations')->where('location_id', DB::table('branches')->where('branch_id',$us->branch_id)->value('location_id'))->value('city')}}</td>
              <td>{{DB::table('branches')->where('branch_id',$us->branch_id)->value('branch_name')}}</td>
              <td>
                 <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#unassignuser{{$us->userbranch_id}}"><i class="fas fa-user-times"></i></a>
                  <!--Modal For Delete-->
                  <div class="modal fade" id="unassignuser{{$us->userbranch_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Unassign <b>{{DB::table('users')->where(['id'=>$us->user_id])->value('fname').' '.DB::table('users')->where(['id'=>$us->user_id])->value('lname')}}</b> to <b>{{DB::table('locations')->where('location_id', DB::table('branches')->where('branch_id',$us->branch_id)->value('location_id'))->value('city')}} {{DB::table('branches')->where('branch_id',$us->branch_id)->value('branch_name')}} Branch</b></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Are you sure to remove the responsibilty of <b>{{DB::table('users')->where(['id'=>$us->user_id])->value('fname').' '.DB::table('users')->where(['id'=>$us->user_id])->value('lname')}}</b>?
                        </div>
                        <div class="modal-footer">
                            {!!Form::open(['action'=>['UserBranchesController@destroy',$us->userbranch_id],'method'=>'POST'])!!}
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
    @else
      <p>No Users Responsibility</p>
    @endif
@endsection