
@extends('layouts.master')


@section('title','List Category')


		@section('content')
        <br>
        <br>
        <br>
            <form action="/Signup?utm=12345&age=999" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="first_name"><br><br>
                <input type="file" name="thumbnail"><br><br>
                <input type="submit">
            </form>
        @endsection
		