@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-baseline mt-5">
        <h2>Edit Video</h2>
    </div>
    <form action="{{ route('video.update', $video->id) }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $video->name) }}">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Video</label>
            <input class="form-control" type="file" id="formFile" accept="video/*" name="video">
        </div>
        <div>
            <label for="formFile" class="form-label">Current Video</label>
        </div>
        <div class="mb-3">
            <video src="{{ asset('videos/' . $video->file_name) }}" style="max-height: 320px;" controls></video>
        </div>
        <button class="btn btn-primary" type="submit">
            Update
        </button>
    </form>
@endsection
