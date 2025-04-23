@extends('layouts.app')

@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>Profile</h2>
        </div>
        <div class="body">
            <form method="POST" action="{{ route('profile.update') }}">
                <input name="_method" type="hidden" value="PUT">
                {{ csrf_field() }}
                <label for="username">Username</label>
                <div class="form-group">
                    <div class="form-line">
                        <input id="username" name="username" value="{{auth()->user()->name}}" class="form-control" type="text">
                    </div>
                </div>

                <label for="email_address">Email Address</label>
                <div class="form-group">
                    <div class="form-line">
                        <input id="email_address" value="{{auth()->user()->email}}" class="form-control" type="text" disabled>
                    </div>
                </div>

{{--                 <label for="password">Password</label>
                <div class="form-group">
                    <div class="form-line">
                        <input id="password" class="form-control" placeholder="Enter your password" type="password">
                    </div>
                </div>
 --}}
                <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
            </form>
        </div>
    </div>
</div>

@endsection
