@extends('layouts.app')

@section('content')
<div class="container">
    <tags-edit token_value=" {{ csrf_token() }}"
    	errors_string = "{{ json_encode($errors->toArray()) }}"
    	id = "{{ $id }}"
    	name = "{{ $name }}"
    	description = "{{$description}}">
    </tags-edit>
</div>

@endsection
