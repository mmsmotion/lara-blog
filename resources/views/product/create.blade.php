@extends('layouts.app')

@section('title') Product Create @stop

@section("content")
    @php $links = ['product'=>route('product.index')] @endphp
    <x-breadcrumb current-page="Product Create" :links="$links"></x-breadcrumb>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-8">
            <x-card-frame title="Product Create">
                <form method="post" action="{{ route('product.store') }}" id="productCreate" enctype="multipart/form-data">
                    @csrf
                    <x-input label="Product Name" name="title" ></x-input>
                    <div class="row">
                        <div class="col-6">
                            <x-input label="Product Price" type="number" name="price" ></x-input>
                        </div>
                        <div class="col-6">
                            <x-input label="Product Stock" type="number" name="stock" ></x-input>
                        </div>
                    </div>
                    <x-input label="Feature Image" type="file" name="feature_image" ></x-input>
                    <x-text-area label="Product Description" name="description" row="20"></x-text-area>
                    <div class="d-flex align-items-end justify-content-between">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" required>
                            <label class="form-check-label" for="flexSwitchCheckDefault">
                                Confirm
                            </label>
                        </div>
                        <button class="btn btn-primary">Create Product</button>
                    </div>
                </form>

            </x-card-frame>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-4">
            <x-card-frame title="Select Category">
                <div class="mb-3">
                    @foreach($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input" form="productCreate" type="checkbox" name="category[]" {{ in_array($category->id,old('category',[])) ? 'checked' : '' }} value="{{ $category->id }}" id="cat{{ $category->id }}">
                        <label class="form-check-label" for="cat{{ $category->id }}">
                            {{ $category->title }}
                        </label>
                    </div>
                    @endforeach

                    @error("category")
                    <p class="invalid-feedback small">{{ $message }}</p>
                    @enderror
                    @error("category.*")
                    <p class="invalid-feedback small">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Images</label>
                    <input type="file" form="productCreate" class="form-control @error('photo') is-invalid @enderror" name="photo[]" multiple>

                    @error("photo")
                    <p class="invalid-feedback small">{{ $message }}</p>
                    @enderror

                    @error("photo.*")
                    <p class="invalid-feedback small">{{ $message }}</p>
                    @enderror
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </x-card-frame>
        </div>
    </div>
@stop



