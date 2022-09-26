@extends('layout')

@section('styles')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-baseline mt-2">
        <h2>Scores</h2>
        <a class="btn btn-primary" href="{{ route('score.create') }}">Create</a>
    </div>
    @if(count($scores) > 0)
    <div class="card mt-2">
        <div class="card-body">
            <h5 class="card-title">Grade Chart</h5>
            <div id="chart"></div>
        </div>
    </div>
    @endif
    <table class="table table-bordered table-striped mt-2">
        <thead>
        <tr>
            <th scope="col" width="50">#</th>
            <th scope="col">NIM</th>
            <th scope="col">Name</th>
            <th scope="col">Major</th>
            <th scope="col">Scores</th>
            <th scope="col">Final Score</th>
            <th scope="col">Grade</th>
            <th scope="col" width="200">Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($scores as $key => $score)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $score->nim }}</td>
                <td>{{ $score->name }}</td>
                <td>{{ $score->major }}</td>
                <td>
                    <ol>
                        <li>Quiz: {{ $score->quiz }}</li>
                        <li>Task: {{ $score->task }}</li>
                        <li>Presence: {{ $score->presence }}</li>
                        <li>Practice: {{ $score->practice }}</li>
                        <li>Exam: {{ $score->exam }}</li>
                    </ol>
                </td>
                <td>{{ $score->final_score }}</td>
                <td>{{ $score->grade }}</td>
                <td class="text-center">
                    <form action="{{ route('score.destroy', $score->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <a href="{{ route('score.edit', $score->id) }}" class="btn btn-warning">Edit</a>
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">No Data</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection

@section('scripts')
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    @if(count($scores) > 0)
    <script>
        new Chartist.Bar('#chart', {
            labels: @js($data['grades']),
            series: @js($data['scores'])
        }, {
            distributeSeries: true
        });
    </script>
    @endif
@endsection
