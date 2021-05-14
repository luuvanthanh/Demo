@extends('layouts.master')
@section('title','Edit User')
		<!-- import file css (private) -->
@push('css')
<link rel="stylesheet" href="/css/categories/category-edit.css">
@endpush
@section('content')
    <p>Edit User</p>
	@if($errors->any())
   	 <?php echo  implode('', $errors->all('<div>:message</div>')) ?>
	@endif
	
	<form action="{{ route('user.update', $users->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="">User Name</label>
            <input type="text" name="name" value="{{ $users->name }}">
            @error('name')
    			<div class="alert alert-danger">{{ $message }}</div>
			@enderror <br><br>
			<label for="">Email</label>
            <input style="margin-left: 40px;" type="text" name="email" value="{{ $users->email }}"><br><br>
			<label for="">Password</label>
            <input style="margin-left: 10px;" type="text" name="password" value="{{ $users->password }}">
        </div>
        <div class="form-group">
            <a href="{{ route('user.index') }}" class="btn btn-secondary">List User</a>
            <input type="submit" name="submit" value="Update" class="btn btn-primary">
        </div>
    </form>
		
@endsection