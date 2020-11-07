@extends('layouts.mdl')
@section('content')

    <div class="mdl-typography--font-light mdl-typography--display-1-color-contrast">
        Edit Site {{ $site->uri }}
    </div>


    <form method="post" action="/sites/{{ $site->id }}" id="site_form" name="site_form">
        {{ method_field('PATCH') }}
        @csrf

        <div class="paragraph">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <textarea class="mdl-textfield__input" rows="3"
                          name="notes" id="notes">{{ $site->notes }}</textarea>
                <label class="mdl-textfield__label" for="notes">{{ __('Notes') }}</label>
            </div>
        </div>

        <div class="paragraph">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <select id="decision" name="decision">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    <option value="Not Sure">Not Sure</option>
                </select>
            </div>
        </div>

        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"
                type="submit">
            @if($showNext){{ __('Next Site') }}@else{{ __('Complete') }}@endif
        </button>

    </form>

    @if ($showPrevious)
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                onclick="location.href='/sites/{{ $prevId }}/edit'">
            {{ __('Previous Site') }}
        </button>
    @endif

@endsection
