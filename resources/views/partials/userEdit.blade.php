
<div class="container">
@include('partials.errorsuccess')
<form method="POST" action="{{ route('profile/edit') }}" enctype="multipart/form-data">

  {{ csrf_field() }}
  <div class="mb-3">
  <label for="name" class="form-label">Name</label>
  <input type="text" name="name" class="form-control" id="name" value="{{ $user->name ?? old('name') }}" required autofocus>
  </div>
  <div class="mb-3">
  <label for="username" class="form-label" >Username</label>
  <input type="text" name= "username" class="form-control" id="username" value="{{ $user->username ?? old('username') }}" required autofocus>
  <div class="mb-3 mt-3">
  <label for="email" class="form-label">Email address</label>
  <input type="email" name="email" class="form-control" id="email" value="{{ $user->email ?? old('email') }}" required>
  </div>

  <div class="mb-3">
    <label class="custom-file-label form-label" for="chooseFile">Select Profile Image</label>
    <input type="file" name="file" class="custom-file-input form-control" id="chooseFile">
  </div>
  <button type="submit" class="btn btn-primary" >Save</button>
</form>
</div>


