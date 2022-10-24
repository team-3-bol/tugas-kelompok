@extends('layout')

@section('content')
    @if(session()->has('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif
    <div class="d-flex justify-content-between align-items-baseline page-heading">
        <h2>Products</h2>
        <a class="btn btn-primary" href="{{ route('product.create') }}">Create</a>
    </div>
    <div class="card p-3">
        <table class="table table-bordered table-striped m-0">
            <thead>
            <tr>
                <th scope="col" width="50">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Type</th>
                <th scope="col">Stock</th>
                <th scope="col">Purchase Price</th>
                <th scope="col">Selling Price</th>
                <th scope="col" width="200">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $key => $product)
                <tr>
                    <td scope="row">{{ $key + 1 }}</td>
                    <td>
                        <a href="{{ asset('products/' . $product->image) }}" target="_blank">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->type }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->purchase_price }}</td>
                    <td>{{ $product->selling_price }}</td>
                    <td class="text-center">
                        <form action="{{ route('product.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning">Edit</a>
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
    </div>
@endsection
