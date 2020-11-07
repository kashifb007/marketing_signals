@extends('layouts.mdl')
@section('content')

    <div class="mdl-typography--font-light mdl-typography--display-1-color-contrast">
        List Sessions
    </div>

    <main class="mdl-layout__content mdl-color--darkgrey-100">

        <div class="mdc-data-table">
            <div class="mdc-data-table__table-container">
                <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                    <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Session ID</th>
                        <th class="mdl-data-table__cell--non-numeric">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sessions as $session)
                        <tr>
                            <td class="mdc-data-table__cell"><a href="/sessions/{{ $session->id }}">{{ $session->id }}</a></td>
                            <td class="mdc-data-table__cell">{{ $session->created_at->format('d M Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>
@endsection
