
@extends('layouts.master')


@section('title','Create User')

<!-- import file css (private) -->
@push('css')
<link rel="stylesheet" href="/css/categories/category-create.css">
@endpush

		@section('content')
			<h1>Create User</h1>
			<form action="{{ route('user.store') }}" method="post">
				@csrf
				<div class="form-group"	>
					<label for="">User Name</label>
					<input type="text" name="name"
					placeholder="User name" ><br><br>
					<label for="">Email</label>
					<input style="margin-left: 40px;" type="text" name="email"
					placeholder="User name" ><br><br>
					<label for="">Password</label>
					<input style="margin-left: 10px;" type="text" name="password"
					placeholder="User name" >
				</div>
				<div class="form-group"	>
					<a href="{{ route('user.index') }}" class="btn btn-secondary">List User</a>
					<button type="submit" class="btn btn-primary">Create</button>
				<div>
			</form>
        @endsection