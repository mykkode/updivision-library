@extends('layouts.app')

@section('content')
<div class="container">
    <authors-edit token_value=" {{ csrf_token() }}"
    	errors_string = "{{ json_encode($errors->toArray()) }}"
    	id = "{{ $id }}"
    	name = "{{ $name }}"
    	description = "{{$description}}">
    </authors-edit>
</div>

@endsection
