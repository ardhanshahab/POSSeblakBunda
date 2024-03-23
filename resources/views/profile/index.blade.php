@extends('master');

@section('title', 'Profile Settings')

@section('content')
<div class="page-header">
   <h3 class="page-title">Profile settings page</h3>
</div>
<div class="col-12">
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
</div>
<div class="col-12 grid-margin stretch-card">
   <div class="card">
      <div class="card-body">
         <h4 class="card-title">Update profile</h4>
         <form class="forms-sample" action="/profile/settings/update/{{ $profile->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="old_image" value="{{ $profile->profile_image }}">
            <div class="form-group">
               <label for="inputName">Name</label>
               <input type="text" class="form-control @error('name') is-invalid @enderror"
                  id="inputName" name="name" placeholder="Name" value="{{ $profile->name }}">
               @error('name')
               <span style="color: red;">{{ $message }}</span>
               @enderror
            </div>
            <div class="form-group">
               <label for="inputUsername">Username</label>
               <input type="text" class="form-control @error('username') is-invalid @enderror"
                  id="inputUsername" name="username" placeholder="Username" value="{{ $profile->username }}">
               @error('username')
               <span style="color: red;">{{ $message }}</span>
               @enderror
            </div>
            <div class="form-group">
               <label for="inputImage">Profile Image</label>
               <input type="file" class="form-control @error('profile_image') is-invalid @enderror" id="inputImage"
                  name="profile_image">
               @if ($profile->profile_image != null)
                  <img class="mt-3" src="{{ asset($profile->profile_image) }}" style="width: 75px; height: 75px;" alt="Profile Image">
               @endif
               @error('profile_image')
               <span style="color: rgb(255, 71, 71);">{{ $message }}</span>
               @enderror
            </div>
            <button type="submit" class="btn btn-primary mr-2 mt-3">Submit</button>
            <a href="/profile/remove/photo/{{ $profile->id }}" onclick="return confirm('Are you sure to delete?')"><button type="button" class="btn btn-outline-danger btn-icon-text mr-2 mt-3">Remove Photo</button></a>
         </form>
      </div>
   </div>
</div>
@endsection