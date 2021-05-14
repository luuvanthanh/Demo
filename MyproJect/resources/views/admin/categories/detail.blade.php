
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
				</tr>
			</thead>
			<tbody>
				@if(!empty($categories))
				    @foreach($categories as $key => $category)
				    <tr class="text-center">
				    	<td>{{$category->id}}</td>
				    	<td>{{$category->name}}</td>
				    	<td>
				    		<form action="{{ route('admin.category.destroy', $category->id) }}" method="delete">
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