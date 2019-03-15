@extends('layouts.app')

@section('content')

<section class="section">
<h2 class="title is-2">{{ __('Register') }}</h2>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="field">
        <label class="label">{{ __('FirstName') }}</label>
        <div class="control has-icons-left">
            <input id="first_name" name="first_name" class="input {{ $errors->has('first_name') ? ' is-danger' : '' }}" type="text" placeholder="Text input" value="{{ old('first_name') }}" required>
            <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
            </span>
        </div>
        @if ($errors->has('first_name'))
            <p class="help is-danger">{{ $errors->first('first_name') }}</p>
        @endif
    </div>

    <div class="field">
        <label class="label">{{ __('LastName') }}</label>
        <div class="control has-icons-left">
            <input id="last_name" name="last_name" class="input {{ $errors->has('last_name') ? ' is-danger' : '' }}" type="text" placeholder="Text input" value="{{ old('last_name') }}" required>
            <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
            </span>
        </div>
        @if ($errors->has('first_name'))
            <p class="help is-danger">{{ $errors->first('last_name') }}</p>
        @endif
    </div>


    <div class="field">
        <label class="label">{{ __('E-Mail Address') }}</label>
        <div class="control has-icons-left has-icons-right">
            <input id="email" name="email" class="input {{ $errors->has('email') ? ' is-danger' : '' }}" type="email" placeholder="Email input" value="{{ old('email') }}" required>
            <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
            </span>
            <span class="icon is-small is-right">
                <i class="fas fa-exclamation-triangle"></i>
            </span>
        </div>
        @if ($errors->has('email'))
            <p class="help is-danger">{{ $errors->first('email') }}</p>
        @endif
    </div>

    <div class="field">
        <label class="label">{{ __('Password') }}</label>
        <p class="control has-icons-left">
            <input id="password" name="password" class="input {{ $errors->has('password') ? ' is-danger' : '' }}" type="password" placeholder="{{ __('Password') }}" required>
            <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
            </span>
        </p>
        @if ($errors->has('password'))
            <p class="help is-danger">{{ $errors->first('password') }}</p>
        @endif
    </div>

    <div class="field">
        <label class="label">{{ __('Confirm Password') }}</label>
        <p class="control has-icons-left">
            <input id="password-confirm" name="password_confirmation" class="input" type="password" required>
            <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
            </span>
        </p>
    </div>

                        

    <div class="field is-grouped">
        <div class="control">
            <button type="submit" class="button is-link">{{ __('Register') }}</button>
        </div>
    </div>
</form>
</section>

@endsection
