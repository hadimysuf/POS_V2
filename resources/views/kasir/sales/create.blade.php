@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create New Sale</h2>
        <form method="POST" action="{{ route('sales.store') }}">
            @csrf
            <div class="form-group">
                <label for="products">Products</label>
                <select name="products[]" class="form-control" multiple>
                    @foreach($products as $product)
                        <option value="{{ $product['id'] }}">{{ $product['name'] }} - {{ $product['price'] }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
@endsection
    