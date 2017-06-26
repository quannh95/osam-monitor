@extends('master')
@section('title', 'Admin Dashboard')
@section('page-header', 'Add User')
@section('content')
            <!-- /.row -->
<div class="row">
	<div class="col-md-6">
		<form action="{{ route('admin.add.submit') }}" method="POST">
	    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
	        <div class="form-group">
	            <label>Username</label>
	            <input class="form-control" name="name" placeholder="Please Enter Username" />
	            <span class="text text-danger">{{ $errors->first('name')}}</span>
	        </div>
	        <div class="form-group">
	            <label>Password</label>
	            <input type="password" class="form-control" name="password" placeholder="Please Enter Password" />
	            <span class="text text-danger">{{ $errors->first('password')}}</span>
	        </div>
	        <div class="form-group">
	            <label>Confirm Password</label>
	            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" />
	            <span class="text text-danger">{{ $errors->first('password_confirmation')}}</span>
	        </div>
	        <div class="form-group">
	            <label>Email</label>
	            <input type="email" class="form-control" name="email" placeholder="Please Enter Email" />
	            <span class="text text-danger">{{ $errors->first('password')}}</span>
	        </div>
	        <div class="form-group">
	            <label>Role</label>
	            <label class="radio-inline">
	                <input name="rdoLevel" value="1" checked="" type="radio">Admin
	            </label>
	            <label class="radio-inline">
	                <input name="rdoLevel" value="2" type="radio">Member
	            </label>
	        </div>
	        <span class="text text-danger">{{ $errors->first('password')}}</span>
	        <button type="submit" class="btn btn-primary">User Add</button>
	        <button type="reset" class="btn btn-danger">Reset</button>
	    <form>
	</div>
</div>
@endsection
