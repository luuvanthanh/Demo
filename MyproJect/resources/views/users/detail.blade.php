
@extends('layouts.master')


@section('title','Detail User')

<!-- import file css (private) -->
@push('css')

@endpush

		@section('content')
			<table id="category-list"  class="table table-bordered table-hover">
			<thead>
				<tr class="text-center">
					<th>id</th>
					<th>User Name</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
				@if(!empty($users))
				    @foreach($users as $key => $user)
				    <tr class="text-center">
				    	<td>{{$user->id}}</td>
				    	<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
				    	<td>
				    		<form action="{{ route('user.destroy', $user->id) }}" method="delete">
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