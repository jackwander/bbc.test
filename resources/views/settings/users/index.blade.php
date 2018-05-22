@extends('layouts.app')

@section('content')
  
    <h1>Bank Officers <small><a href="/settings/users/create" class="btn btn-secondary"><i class="fas fa-plus"></i></a></small></h1>
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-striped table-hover" id="users-table">
          <thead class="thead-dark">
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Action</th>
          </thead>
        </table>
      </div>
    </div>
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatables.data') !!}',
        columns: [
            { data: 'fname', name: 'fname' },
            { data: 'mname', name: 'mname' },
            { data: 'lname', name: 'lname' },
            { data: 'email', name: 'email' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
    });
});
</script>
@endsection
