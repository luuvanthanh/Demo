
@extends('admin.layouts.master')


@section('title','List Post')

<!-- import file css (private) -->
@push('css')
<link rel="stylesheet" href="/admin/css/posts/post-list.css">
@endpush

		@section('content')
		{{-- show message --}}
		@if(Session::has('success'))
        <p class="text-success">{{ Session::get('success') }}</p>
    	@endif

  		  {{-- show error message --}}
  	  	{{-- @if(Session::has('error'))
        	<p class="text-danger">{{ Session::get('error') }}</p>
    	@endif --}}
		<!-- form search -->
		{{-- <form class="row g-3">
			<div class="col-auto">
				<label class="form-control-plaintext">Post Name</label>
			</div>
			<div class="col-auto">
				<input type="text" class="form-control"  placeholder="">
			</div>
			<div class="col-auto">
				<button type="submit" class="btn btn-danger mb-3">Search </button>
			</div>
		</form> --}}
		@include('posts._search')
		<br>
		<br>
		<br>	
		<!-- create category link -->
		<a href="{{ route('admin.post.create') }}"><button type="button" class="btn btn-danger">Create</button></a>
		<!-- <a href="/category/create"><button type="button" class="btn btn-danger">Create</button></a> -->
		<br>
		<br>
		<br>		
		<!-- display list category table -->
		<table id="category-list"  class="table table-bordered table-hover">
			<thead>
				<tr class="text-center">
					<th>#</th>
					<th>Name</th>
					<th>Thumbnail</th>
					<th>CategoryID</th>
					<th>Status</th>
					<th colspan="3">Action</th>
				</tr>
			</thead>
			<tbody>
				@if(!empty($posts))
				    @foreach($posts as $key => $post)
				    <tr class="text-center">
				    	<td>{{$key+1}}</td>
				    	<td>{{$post->name}}</td>
						<td><img width="100px" src="/{{$post->thumbnail}}" alt=""></td>
						<td>{{$post->category->name}}</td>
						<td>{{$post->status}}</td>
				    	<td><a href="{{ route('admin.post.show', $post->id) }}">Detail</a></td>
				    	<td><a href="{{ route('admin.post.edit', $post->id) }}">Edit</a></td>
				    	<td>
				    		<form action="{{ route('admin.post.destroy', $post->id) }}" method="post">
								@method('DELETE')
				    			@csrf
				    			<input type="submit" value="Delete" name="submit" class="btn btn-danger">
				    		</form>
				    	</td>
				    </tr>
					@endforeach
				@endif
			</tbody>
		</table>
		{{ $posts->appends(request()->input())->links() }}
        @endsection