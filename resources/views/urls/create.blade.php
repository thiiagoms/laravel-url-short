@extends('layouts.template')

@section('title')
    Create URl Short
@endsection

@section('content')
    
    @includeWhen(!empty($errors), 'messages.error', ['errors' => $errors])

    <div class="d-flex justify-content-center mt-4 mb-4 text-center">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Create url short</h1>
        </div>
    </div>

    <form method="POST">
        @csrf
        <div class="row mb-3">
            <label for="url" class="col-sm-2 col-form-label">Url</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="url" name="url" placeholder="Type your URL here">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Short</button>
    </form>

@endsection