@extends('layouts.master')

@section('main')
<div class="container">
    <div class="text-right mt-2">
        <a href="products/create" class="btn btn-dark mt-2 float-right">New Product</a>
    </div>

    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th>Sno.</th>
                <th>Name</th>
                <th>Product</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td><a href="products/{{ $product->id }}/show" class="text-dark">{{ $product->name }}</a></td>
                <td>
                    <img src="products/{{ $product->image }}" class="rounded-circle" width="30" height="30">
                </td>
                <td>
                    <a href="products/{{ $product->id }}/edit" class="btn btn-dark btn-sm">Edit</a>
                    {{-- <a href="" class="btn btn-danger btn-sm">Delete</a> --}}
                    <form method="POST" class="d-inline" action="products/{{ $product->id }}/delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        
    </table>
    
    {{ $products->links() }}
</div>
@endsection
