@extends('layouts.app')

@section('content')
<div class="container">
    <books-edit token_value=" {{ csrf_token() }}"
    	errors_string = "{{ json_encode($errors->toArray()) }}"
    	id = "{{ $id }}">
    </books-edit>
</div>

@endsection
