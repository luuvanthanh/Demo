
@extends('layouts.master')


@section('title','Create Category')

<!-- import file css (private) -->
@push('css')
<link rel="stylesheet" href="/css/categories/category-create.css">
@endpush

		@section('content')
			<h1>Create Category</h1>
			<form action="{{ route('category.store') }}" method="post">
				@csrf
				<div class="form-group"	>
					<label for="">Category Name</label>
					<input type="text" name="category_name"
					placeholder="category name" >
				</div>
				<div class="form-group"	>
					<a href="{{ route('category.index') }}" class="btn btn-secondary">List Category</a>
					<button type="submit" class="btn btn-primary">Create</button>
				<div>
			</form>
        @endsection