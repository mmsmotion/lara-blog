@extends('layouts.app')

@section('title') Product Edit @stop

@section("content")
    @php $links = ['product'=>route('product.index')] @endphp
    <x-breadcrumb current-page="Product Edit" :links="$links"></x-breadcrumb>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-8">
            <x-card-frame title="Product Edit">
                <form method="post" action="{{ route('product.update',$product->id) }}" id="productCreate" enctype="multipart/form-data">
                    @csrf
                    <x-input label="Product Name" name="title" value="{{ $product->title }}" ></x-input>
                    <div class="row">
                        <div class="col-6">
                            <x-input label="Product Price" value="{{ $product->price }}" type="number" name="price" ></x-input>
                        </div>
                        <div class="col-6">
                            <x-input label="Product Stock" value="{{ $product->stock }}" type="number" name="stock" ></x-input>
                        </div>
                    </div>
                    <x-text-area label="Product Description" name="description" row="20" value="{{ $product->description }}"></x-text-area>
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

                <x-input label="Feature Image" type="file" form="productCreate" name="feature_image" ></x-input>

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

            <x-card-frame title="Test Card 2">

                <form action="{{ route('photo.store') }}" method="post" id="photoUpdate" enctype="multipart/form-data" class="mb-3">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="mb-3">
                        <label class="form-label">Product Images</label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo[]" id="photoInput" multiple>
                        @error("photo")
                        <p class="invalid-feedback small">{{ $message }}</p>
                        @enderror

                        @error("photo.*")
                        <p class="invalid-feedback small">{{ $message }}</p>
                        @enderror
                    </div>
                </form>

                <div class="d-flex overflow-scroll">
                    @foreach($product->photos as $photo)

                        <div class="mb-3 position-relative me-2">
                            <x-veno-box small="{{ asset('storage/product_photo/'.$photo->name) }}" height="150" gall="photo"></x-veno-box>
                            <form action="{{ route('photo.destroy',$photo->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger position-absolute " style="bottom: 3px; right: 3px;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>

                    @endforeach
                </div>

            </x-card-frame>
        </div>
    </div>
@stop

@section('foot')
    <script>

        let photoUpdate = document.getElementById('photoUpdate');
        let photoInput = document.getElementById("photoInput");
        photoInput.addEventListener('change',function (){
            console.log("hello")
            photoUpdate.submit();
        })

    </script>
@endsection



