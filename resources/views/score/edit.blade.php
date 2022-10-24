@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-baseline page-heading">
        <h2>Update Score</h2>
    </div>
    <div class="card p-3">
        <form action="{{ route('score.update', $score->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim', $score->nim) }}">
                @error('nim')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $score->name) }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="major" class="form-label">Major</label>
                <input type="text" class="form-control @error('major') is-invalid @enderror" id="major" name="major" value="{{ old('major', $score->major) }}">
                @error('major')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="quiz" class="form-label">Quiz</label>
                        <input type="number" class="form-control @error('quiz') is-invalid @enderror" id="quiz" name="quiz" value="{{ old('quiz', $score->quiz) }}">
                        @error('quiz')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="task" class="form-label">Task</label>
                        <input type="number" class="form-control @error('task') is-invalid @enderror" id="task" name="task" value="{{ old('task', $score->task) }}">
                        @error('task')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="presence" class="form-label">Presence</label>
                        <input type="number" class="form-control @error('presence') is-invalid @enderror" id="presence" name="presence" value="{{ old('presence', $score->presence) }}">
                        @error('presence')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="practice" class="form-label">Practice</label>
                        <input type="number" class="form-control @error('practice') is-invalid @enderror" id="practice" name="practice" value="{{ old('practice', $score->practice) }}">
                        @error('practice')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="exam" class="form-label">Exam</label>
                        <input type="number" class="form-control @error('exam') is-invalid @enderror" id="exam" name="exam" value="{{ old('exam', $score->exam) }}">
                        @error('exam')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">
                Update
            </button>
        </form>
    </div>
@endsection
