@extends('layouts.template')

@section('title')
    Urls list
@endsection

@section('content')

    <div class="d-flex justify-content-center mt-4 mb-4 text-center">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Urls List</h1>
        </div>
    </div>

    <a href="{{ route('urls.create') }}" class="btn btn-dark mb-2">Add</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Url</th>
                <th scope="col">Short</th>
                <th scope="col">Clicks</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($urls as $url)
                <tr>
                    <td>{{ $url['original'] }}</td>
                    <td>
                        <a href="{{ route('urls.redirect', ['short' => $url['short'] ]) }}">
                            {{ $url['short'] }}
                        </a>
                    </td>
                    <td>{{ $url['clicks'] }}</td>
                </tr>
            @endforeach`
        </tbody>
    </table>

@endsection