@extends('layouts.app')

@section('title') Product @stop

@section("content")
    <x-breadcrumb current-page="Test Page"></x-breadcrumb>

    <div class="row">
        <div class="">
            <x-card-frame title="Product List">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>User</th>
                        <th>Control</th>
                        <th>Created_at</th>
                    </tr>
                    </thead>
                    <tbody>

                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <img src="{{ asset('storage/feature_image/'.$product->feature_image) }}" class="me-2 rounded-circle shadow-sm border border-3" width="30" height="30" alt="">
                                    {{ $product->title }}
                                </td>
                                <td>
                                    @foreach($product->categories as $category)
                                        <span class="badge bg-primary rounded-pill">
                                            {{ $category->title }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    {{ $product->user->name }}
                                </td>
                                <td>
                                    <a href="{{ route('product.show',$product->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('product.edit',$product->id) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <p class="small mb-0">
                                        <i class="fas fa-clock"></i>
                                        {{ $product->created_at->format("h : i a") }}
                                    </p>
                                    <p class="small mb-0">
                                        <i class="fas fa-calendar"></i>
                                        {{ $product->created_at->format("d m Y") }}
                                    </p>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">There is no Product</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>


            </x-card-frame>
        </div>
    </div>
@stop



