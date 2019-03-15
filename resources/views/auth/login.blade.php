@extends('layouts.app')

@section('content')

<section class="section">
<h2 class="title is-2">{{ __('Login') }}</h2>
<form method="POST" action="{{ route('login') }}">
    @csrf
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
            <p class="help is-danger">This email is invalid</p>
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
            <p class="help is-danger">This email is invalid</p>
        @endif
    </div>

    <div class="field">
        <div class="control">
        <label class="checkbox">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            {{ __('Remember Me') }}
        </label>
        </div>
    </div>

    <div class="field is-grouped">
        <div class="control">
            <button type="submit" class="button is-link">{{ __('Login') }}</button>
        </div>
    </div>
</form>
</section>
@endsection
