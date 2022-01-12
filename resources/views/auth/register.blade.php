@extends('layouts.app')

@section('content')


<form class="row g-3 needs-validation" method="POST" action="{{ route('register') }}" novalidate>

    @include('partials.errorsuccess')
    {{ csrf_field() }}
    <div class="form-floating mb-3">
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
        <label for="validationServer02" class="form-label">Name</label>
        <div class="invalid-feedback">
            Please choose a name.
      </div>
    </div>
    <div class="form-floating mb-3">
        <input type="text" placeholder= "Username"name= "username" class="form-control" id="username" value="{{ old('username') }}" required autofocus>
        <label for="validationServer02" class="form-label" >Username</label>
        <div class="invalid-feedback">
            Please choose a username.
      </div>
    </div>
    <div class="form-floating mb-3">
        <input type="email" placeholder= "Email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
        <label for="email" class="form-label">Email address</label>
        <div class="invalid-feedback">
            Please enter an email.
      </div>
    </div>
    <div class="form-floating mb-3">
        <input type="password" name= "password" class="form-control" id="password" placeholder="Password" required>
        <label for="password" class="form-label">Password</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" name= "password_confirmation"  placeholder="Confirm Password" class="form-control" id="password-confirm" required>
        <label for="password-confirm" class="form-label">Confirm Password</label>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary" >Register</button>
    </div>
   
</form>

<script>
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
</script>
@endsection
