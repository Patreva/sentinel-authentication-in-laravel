@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
           <div class="panel panel-primary">
               <div class="panel-heading">
                   <h3 class="panel-title">
                       Login
                   </h3>

               </div>
               <div class="panel-body">
                       <form action="/login" method="POST">
                           {{ csrf_field() }}
                           @if(session('error'))
                           <div class="alert alert-danger">
                            {{session('error')}}
                           </div>
                           @endif
                           @if(session('success'))
                           <div class="alert alert-success">
                            {{session('success')}}
                           </div>
                           @endif
                           <div class="form-group">
                                <div class="input-group">
                                   <span class="input-group-addon"> <i class="fa fa-envelope"></i></span>
                                   <input type="email" name="email" class="form-control" placeholder="example@example.com" required>
                                </div>
                           </div>
                            <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                Remember Me
                                <input type="checkbox" name="remember_me">
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="input-group">
                            <input type="submit" value="Login" class="btn btn-success" >
                        </div>
                    </div>
                    <a href="/forgot-password">Forgot your password?</a>
                       </form>
               </div>
           </div>
        </div>
    </div>
@endsection
