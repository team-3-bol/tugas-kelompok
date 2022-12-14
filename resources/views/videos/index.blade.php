@extends('layout')

@section('content')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-baseline page-heading">
        <h2>Videos</h2>
        <a class="btn btn-primary" href="{{ route('video.create') }}">Create</a>
    </div>
    <div class="card p-3">
        <table class="table table-bordered table-striped m-0">
            <thead>
            <tr>
                <th scope="col" width="50">#</th>
                <th scope="col">Name</th>
                <th scope="col" width="200">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($videos as $key => $video)
                <tr>
                    <td scope="row">{{ $key + 1 }}</td>
                    <td>
                        <a href="{{ asset('videos/' . $video->file_name) }}">
                            {{ $video->name }}
                        </a>
                    </td>
                    <td class="text-center">
                        <form action="{{ route('video.destroy', $video->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('video.edit', $video->id) }}" class="btn btn-warning">Edit</a>
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No Data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
