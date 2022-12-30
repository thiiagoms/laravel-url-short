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

    @include('messages.message')

    <a href="{{ route('url.create') }}" class="btn btn-dark mb-2">Add</a>

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
                    <td>{{ $url['origin'] }}</td>
                    <td>
                        <a href="{{ $url['origin'] }}"
                            onclick="addClickCounter('{{ $url['short'] }}')">
                            {{ $url['short'] }}
                        </a>
                    </td>
                    <td>{{ $url['clicks'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @section('scripts')
        <script>
            function addClickCounter(shortLink) {
                $.post(
                    '{{ route("api.url.count") }}',
                    {
                        "_token": "{{ csrf_token() }}",
                        short: shortLink
                    },
                    function data(data) {
                        console.log(data);
                    }
                );
            }
        </script>
    @endsection

@endsection
