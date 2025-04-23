@extends('layouts.app')

@push('css')
<style>
/* style inputs and link buttons */
input,
.btn {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 4px;
  margin: 5px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  line-height: 20px;
  text-decoration: none; /* remove underline from anchors */
}

input:hover,
.btn:hover {
  opacity: 1;
}

/* add appropriate colors to fb, twitter and google buttons */
.fb {
  background-color: #3B5998;
  color: white;
}

.twitter {
  background-color: #55ACEE;
  color: white;
}

.google {
  background-color: #dd4b39;
  color: white;
}

/* style the submit button */
input[type=submit] {
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

</style>
@endpush


@section('content')
<div class="container">
    <div class="login-box col-md-6">
        <div class="text-center">
            <h2>Already a member?</h2>
        </div>
        <div class="card">
            <div class="body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">person</i></span>
                        <div class="form-line">
                            <input class="form-control" name="email" placeholder="Email address" required="" autofocus="" aria-required="true" type="text">
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">lock</i></span>
                        <div class="form-line">
                            <input class="form-control" name="password" placeholder="Password" required="" aria-required="true" type="password">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input name="rememberme" id="rememberme" class="filled-in chk-col-green" type="checkbox">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-12">
                            <button class="btn btn-block btn-lg bg-green waves-effect" type="submit">LOG IN</button>
                            <a href="{{route('fake.social.login')}}" class="fb btn"><i class="fa fa-facebook fa-fw"></i> Login with Facebook</a>
                            <a href="{{route('fake.social.login')}}" class="twitter btn"><i class="fa fa-twitter fa-fw"></i> Login with Twitter</a>
                            <a href="{{route('fake.social.login')}}" class="google btn"><i class="fa fa-google fa-fw"></i> Login with Google+</a>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="signup-box col-md-6">
        <div class="text-center">
            <h2>New User?</h2>
        </div>
        <div class="card">
            <div class="body">
              <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                    <div class="form-line">
                        <input class="form-control" name="name" placeholder="Username" required="" autofocus="" aria-required="true" type="text">
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line">
                        <input class="form-control" name="email" placeholder="Email Address" required="" aria-required="true" type="email">
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="material-icons">lock</i></span>
                    <div class="form-line">
                        <input class="form-control" name="password" minlength="6" placeholder="Password" required="" aria-required="true" type="password">
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="material-icons">lock</i></span>
                    <div class="form-line">
                        <input class="form-control" name="password_confirmation" minlength="6" placeholder="Confirm Password" required="" aria-required="true" type="password">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-8 p-t-5">
                     <input name="terms" id="terms" class="filled-in chk-col-blue" type="checkbox">
                     <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                 </div>
             </div>
             <button class="btn btn-block btn-lg bg-blue waves-effect" type="submit">SIGN UP</button>
        </form>
    </div>
</div>
</div>
</div>
@endsection
