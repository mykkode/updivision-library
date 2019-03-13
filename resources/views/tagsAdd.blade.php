@extends('layouts.app')

@section('content')

<div class="container">
    <tags-add token_value=" {{ csrf_token() }}"
    	errors_string = "{{ json_encode($errors->toArray()) }}">
    		
    </tags-add>
</div>
@endsection
