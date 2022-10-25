@extends('layout')

@section('content')
    @if(session()->has('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif
    <div class="d-flex justify-content-between align-items-baseline page-heading">
        <h2>Staffs</h2>
        <a class="btn btn-primary" href="{{ route('staff.create') }}">Create</a>
    </div>
    <div class="card p-3">
        <table class="table table-bordered table-striped m-0">
            <thead>
            <tr>
                <th scope="col" width="50">#</th>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
                <th scope="col" width="200">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($staffs as $key => $staff)
                <tr>
                    <td scope="row">{{ $key + 1 }}</td>
                    <td>{{ $staff->name }}</td>
                    <td>{{ $staff->username }}</td>
                    <td>{{ $staff->email }}</td>
                    <td>{{ $staff->profile->gender == 'M' ? 'Male' : 'Female' }}</td>
                    <td class="text-center">
                        <form action="{{ route('staff.destroy', $staff->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-warning">Edit</a>
                            @if($staff->id != auth()->id())
                                <button class="btn btn-danger">Delete</button>
                            @endif
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No Data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
