@extends('master')
@section('title', 'Admin Dashboard')
@section('page-header', 'Edit User')
@section('content')

<div class="col-lg-7" style="padding-bottom:120px">
    <form action="{{ route('admin.edit.submit', $data->id) }}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">

    <div class="form-group">
        <label>Username</label>
        <input class="form-control" name="name" placeholder="Please Enter Username" value="{{ $data->name }}" />
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" disabled value="{!! old('email', isset($data) ? $data['email'] : null) !!}" />
    </div>
    <div class="form-group">
        <input type="checkbox" id="changpass" name="changpass">
        <label>Change Password</label>
        <input type="password" class="form-control password" name="password" placeholder="Please Enter Password" disabled />
    </div>
    <div class="form-group">
        <label>RePassword</label>
        <input type="password" class="form-control password" name="confirmation_password" placeholder="Please Enter RePassword" disabled />
    </div>
    
    <div class="form-group">
        <label>Role</label>
        <label class="radio-inline">
            <input name="rdoLevel" value="1" type="radio" @if ($data["role"] == 1) checked="checked" @endif>Admin
        </label>
        <label class="radio-inline">
            <input name="rdoLevel" value="2" type="radio" @if ($data["role"] == 2) checked="checked" @endif>Member
        </label>
    </div>
    <button type="submit" class="btn btn-primary">User Edit</button>
    <button type="reset" class="btn btn-danger">Reset</button>
    <form>
</div>

@endsection