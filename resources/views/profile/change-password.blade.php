@extends('master');

@section('title', 'Change Password')

@section('content')
<div class="page-header">
   <h3 class="page-title">Change Password page</h3>
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
         <h4 class="card-title">Change password</h4>
         <form class="forms-sample" action="{{ route('change.password.update') }}" method="POST">
            @csrf
            <div class="form-group">
               <label for="current_password">Current Password</label>
               <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                  id="current_password" name="current_password" placeholder="Current Password">
               @error('current_password')
               <span style="color: red;">{{ $message }}</span>
               @enderror
            </div>
            <div class="form-group">
               <label for="new_password">New Password</label>
               <input type="password" class="form-control @error('password') is-invalid @enderror" id="new_password"
                  name="password" placeholder="New Password">
               @error('password')
               <span style="color: red;">{{ $message }}</span>
               @enderror
            </div>
            <div class="form-group">
               <label for="confirm_password">Confirm Password</label>
               <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                  id="confirm_password" name="password_confirmation" placeholder="Confirm Password">
               @error('password_confirmation')
               <span style="color: red;">{{ $message }}</span>
               @enderror
            </div>
            <button type="submit" class="btn btn-primary mr-2 mt-3">Submit</button>
         </form>
      </div>
   </div>
</div>
@endsection