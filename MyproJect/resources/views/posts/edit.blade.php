@extends('layouts.master')


@section('title','Edit Post')

<!-- import file css (private) -->
@push('css')
<link rel="stylesheet" href="/css/posts/post-create.css">
@endpush

		@section('content')
			<h1>Edit Post</h1>
			<form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="form-group mb-5">
					<label for="">Post Name</label>
					<input type="text" name="name" placeholder="post name" value="{{ old('name', $post->name) }}" class="form-control">
					@error('name')
						<div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group mb-5">
					<label for="">Post Thumbnail</label>
					<img width="200px;" src="{{ asset($post->thumbnail) }}" alt="{{ $post->name }}" class="img-fluid">
					<input type="file" name="thumbnail" placeholder="post thumbnail" class="form-control">
					@error('thumbnail')
						<div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group mb-5">
					<label for="">Post Content</label>
					<textarea name="content" rows="10" class="form-control">{{ old('content', $post->post_detail ? $post->post_detail->content : null) }}</textarea>
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
								<option value="{{ $categoryId }}" {{ old('category_id', $post->category_id) == $categoryId ? 'selected' : ''  }}>{{ $categoryName }}</option>
							@endforeach
						@endif
					</select>
					@error('category_id')
						<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					<label for="">Post status</label>
					<input type="text" name="status" placeholder="post name" value="{{ old('status', $post->status) }}" class="form-control">
				</div>
				<div class="form-group">
					<a href="{{ route('post.index') }}" class="btn btn-secondary">List Post</a>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>
        @endsection


