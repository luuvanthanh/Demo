
@extends('admin.layouts.master')


@section('title','Detail Category')

<!-- import file css (private) -->
@push('css')

@endpush

		@section('content')
			<table id="category-list"  class="table table-bordered table-hover">
			<thead>
				<tr class="text-center">
					<th>id</th>
					<th>Category Name</th>
					<th>Thumbnail</th>
					<th>Category ID</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@if(!empty($posts))
				    @foreach($posts as $key => $post)
				    <tr class="text-center">
				    	<td>{{$post->id}}</td>
				    	<td>{{$post->name}}</td>
						<td>{{$post->thumbnail}}</td>
						<td>{{$post->category_id}}</td>
						<td>{{$post->status}}</td>
				    	<td>
				    		<form action="{{ route('admin.post.destroy', $post->id) }}" method="delete">
				    			@csrf
				    			<input type="submit" value="Delete" name="submit" class="btn btn-danger">
				    		</form>
				    	</td>
				    </tr>
					@endforeach
				@endif
			</tbody>
		</table>
        @endsection