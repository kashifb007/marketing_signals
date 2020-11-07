@extends('layouts.mdl')
@section('content')

    <div class="mdl-typography--font-light mdl-typography--display-1-color-contrast">
        Create a New Session
    </div>

    <form method="post" action="{{ route('sessions.store') }}" id="session_form" name="session_form">
        @csrf

        <div class="paragraph">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <textarea class="mdl-textfield__input" rows="3" required
                          name="sites" id="sites">{{ old('sites') }}</textarea>
                <label class="mdl-textfield__label" for="sites">{{ __('Enter list of sites') }}</label>
            </div>
        </div>

        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        <button type="submit"
                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
            {{ __('Next') }}
        </button>
    </form>

@endsection
