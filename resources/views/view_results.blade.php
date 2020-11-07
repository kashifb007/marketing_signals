@extends('layouts.mdl')
@section('content')

    <div class="mdl-typography--font-light mdl-typography--display-1-color-contrast">
        List Site Results of Session {{ $session->id }}
    </div>

    <main class="mdl-layout__content mdl-color--darkgrey-100">

            <div class="mdc-data-table">
                <div class="mdc-data-table__table-container">
                    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                        <thead>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">ID</th>
                            <th class="mdl-data-table__cell--non-numeric">Site URL</th>
                            <th class="mdl-data-table__cell--non-numeric">Notes</th>
                            <th class="mdl-data-table__cell--non-numeric">Decision</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sites as $site)
                            <tr>
                                <td class="mdc-data-table__cell"><a href="/sites/{{ $site->id }}/edit">{{ $site->id }}</a></td>
                                <td class="mdl-data-table__cell--non-numeric">{{ $site->uri }}</td>
                                <td class="mdl-data-table__cell--non-numeric">{{ substr($site->notes, 0, 20) }}</td>
                                <td class="mdl-data-table__cell--non-numeric">{{ $site->decision }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                onclick="location.href='/sessionResults/{{ $session->id }}'">
            {{ __('Export Results to CSV') }}
        </button>

    </main>

    <!-- Required MDC Web JavaScript library -->
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <script>
        const dataTable = [].map.call(document.querySelectorAll('.mdc-data-table'), function (el) {
            return new mdc.dataTable.MDCDataTable(el);
        });
    </script>
@endsection
