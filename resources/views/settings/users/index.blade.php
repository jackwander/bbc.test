@extends('layouts.app')

@section('content')
  
    <h1>Users <small><a href="/settings/users/create" class="btn btn-secondary"><i class="fas fa-plus"></i></a></small></h1>
  @if(count($users) > 0)
      <table class="table table-striped table-hover">
        <thead class="thead-dark">
          <th>Name</th>
          <th>Email</th>
          <th>Position</th>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
              <td>{{$user->fname.' '.$user->lname}} </td>
              <td>{{$user->email}}</td>
              <td>{{ ('Bank Officer' )}}</td>
            </tr>
          @endforeach          
        </tbody>
      </table>
      {{$users->links()}}
  @else
      <p>No Users Found</p>
  @endif
@endsection