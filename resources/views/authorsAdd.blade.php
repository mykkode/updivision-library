@extends('layouts.app')

@section('content')

<div class="container">
    <authors-add token_value=" {{ csrf_token() }}"
    	errors_string = "{{ json_encode($errors->toArray()) }}">
    		
    </authors-add>
</div>
@endsection
