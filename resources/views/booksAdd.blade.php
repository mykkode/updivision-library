@extends('layouts.app')

@section('content')

<div class="container">
    <books-add token_value=" {{ csrf_token() }}"
    	errors_string = "{{ json_encode($errors->toArray()) }}">
    		
    </books-add>
</div>
@endsection
