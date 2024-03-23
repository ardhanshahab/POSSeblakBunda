@extends('master');

@section('title', 'Admin')

@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
   {{ session ('success') }}
</div>
@endif
@if (session('danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
   {{ session ('danger') }}
</div>
@endif
<div class="card">
   <div class="card-body">
      <h4 class="card-title">All User</h4>
      <a href="{{ route('admin.create') }}"><button type="button" class="btn btn-primary btn-fw">Create
            User</button></a> @if ($users->count()) <div class="table-responsive mt-4">
         <table class="table table-bordered mb-4">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($users as $user)
               <tr>
                  <td>{{ $users->firstItem() + $loop->index }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->role }}</td>
                  <td>
                     <a href="/admin/dashboard/edit/{{ $user->id }}"><button type="button"
                           class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                     <a href="/admin/dashboard/delete/{{ $user->id }}"
                        onclick="return confirm('Are you sure to delete?')"><button type="button"
                           class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i></button></a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         {{ $users->links() }}
      </div>
      @else
      <p class="text-center h4 mt-5 mb-3">No Users Found</p>
      @endif
   </div>
</div>
@endsection