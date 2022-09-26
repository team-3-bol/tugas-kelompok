@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-baseline">
        <h2>Add New Video</h2>
    </div>
    <form action="{{ route('video.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Video</label>
            <input class="form-control @error('video') is-invalid @enderror" type="file" id="formFile" accept="video/*" name="video">
            @error('video')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit">
            Submit
        </button>
    </form>
@endsection
