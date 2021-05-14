
@extends('layouts.master')


@section('title','Create Post')

<!-- import file css (private) -->
@push('css')
<link rel="stylesheet" href="/css/categories/category-create.css">
@endpush

		@section('content')
			<h1>Create Post</h1>

			{{-- @include('errors.error') --}}
			<form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-group mb-5">
					<label for="">Post Name</label>
					<input type="text" name="name" placeholder="post name" value="{{ old('name') }}" class="form-control">
					@error('name')
						<div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group mb-5">
					<label for="">Post Thumbnail</label>
					<input type="file" name="thumbnail" >
					{{-- <textarea name="thumbnail" rows="10" class="form-control">{{ old('thumbnail') }}</textarea> --}}
					@error('thumbnail')
						<div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group mb-5">
					<label for="">Post Content</label>
					<textarea name="content" rows="10" class="form-control">{{ old('content') }}</textarea>
					@error('content')
						<div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group mb-5">
					<label for="">Category</label>
					<select name="category_id" class="form-control">
						<option value=""></option>
						@if(!empty($categories))
							@foreach ($categories as $categoryId => $categoryName)
								<option value="{{ $categoryId }}" {{ old('category_id') == $categoryId ? 'selected' : ''  }}>{{ $categoryName }}</option>
							@endforeach
						@endif
					</select>
					@error('category_id')
						<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					<label for="">Post Status</label>
					<input type="text" name="status" placeholder="post name" value="{{ old('status') }}" class="form-control">
				</div>
				<div class="form-group">
					<a href="{{ route('post.index') }}" class="btn btn-secondary">List Post</a>
					<button type="submit" class="btn btn-primary">Create</button>
				</div>
			</form>
        @endsection