
<form method="POST" action="{{ route('profile/edit') }}">

{{ csrf_field() }}
<div class="mb-3">
<label for="name" class="form-label">Name</label>
<input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required autofocus>
</div>
<div class="mb-3">
<label for="username" class="form-label" >Username</label>
<input type="text" name= "username" class="form-control" id="username" value="{{ old('username') }}" required autofocus>
<div class="mb-3">
<label for="email" class="form-label">Email address</label>
<input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
</div>
<div class="password">
<label for="password" class="form-label">Password</label>
<input type="password" name= "password" class="form-control" id="password" required>

</div>
<div class="password">
<label for="password-confirm" class="form-label">Confirm Password</label>
<input type="password" name= "password_confirmation" class="form-control" id="password-confirm" required>

</div>
<div class="mb-3 form-check">
<input type="checkbox" class="form-check-input" id="exampleCheck1">
<label class="form-check-label" for="exampleCheck1">Remember Me</label>
</div>
<a class="btn btn-secondary" href="{{ route('login') }}"> Login </a>
<button type="submit" class="btn btn-primary" >Register</button>
</form>
