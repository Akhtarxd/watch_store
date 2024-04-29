@extends('admin.adminLayout')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Products</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('product.index')}}"> List</a></li>
                    <li class="breadcrumb-item active">Brands</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Add Brands
                        <!-- <a href="add_new_user.html" class="btn btn-outline-primary btn-sm float-end"> + Add User</a>
                    </div> -->
                    <div class="card-body">

                        @if(session()->has('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{session('error')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                            </div>
                        @endif

                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{route('product.update', ['product' => $product->id])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Product name"
                                       required="" value="{{$product->name}}">
                            </div>
                            <div class="col">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price"
                                       placeholder="Product price"
                                       required="" value="{{$product->price}}">
                            </div>
                            <div class="col">
                                <label for="sale_price" class="form-label">Sale price</label>
                                <input type="number" class="form-control" id="sale_price" name="sale_price"
                                       placeholder="Product sale price"
                                       required="" value="{{$product->sale_price}}">
                            </div>
                            
                        </div>
                        
                        
                        <div class="row mb-3">
                            <div class="col">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description"
                                          placeholder="Description" required="">{{$product->description}}</textarea>
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            
                            <div class="col">
                                <label for="color" class="form-label">Color</label><br>
                                <input type="text" class="form-control-file" name="color" id="color" value="{{$product->color}}">
                            </div>

                            <div class="col">
                                <label for="color" class="form-label">Brand</label><br>
                                <select class="form-select" name="brand_id" id="brand_id" aria-label="Default select example" required>
                                    <option selected disabled>Select</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}"  @if ($product->brand_id == $brand->id) {{'selected'}} @endif>{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="image" class="form-label">Image</label><br>
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="gender" class="form-label">Gender</label><br>
                               <input type="radio" id="gender" name="gender" value="Male" @if ($product->gender == 'Male') {{'checked'}} @endif> Male
                               <input type="radio" id="gender" name="gender" value="Female" @if ($product->gender == 'Female') {{'checked'}} @endif> Female
                               <input type="radio" id="gender" name="gender" value="Children" @if ($product->gender == 'Children') {{'checked'}} @endif> Children
                               <input type="radio" id="gender" name="gender" value="Unisex" @if ($product->gender == 'Unisex') {{'checked'}} @endif> Unisex
                            </div>

                            <div class="col">
                                <label for="function" class="form-label">Function</label><br>
                                <select class="form-select" name="function" id="function" aria-label="Default select example" required>
                                    <option selected disabled>Select</option>
                                    @foreach (\Illuminate\Support\Facades\Config::get('watchFuction') as $value)
                                    <option value="{{$value}}" @if ($product->function == $value) {{'selected'}} @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="stock" class="form-label">Stock</label><br>
                                <input type="text" class="form-control" name="stock" id="stock" value="{{$product->stock}}">
                            </div>
                            <div class="col">
                                <label for="productCode" class="form-label">Product code</label><br>
                                <input type="text" class="form-control" name="product_code" id="product_code" value="{{$product->product_code}}">
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <input type="submit" name="add" id="add" value="Add"
                                   class="btn btn-outline-success">
                        </div>
                    </form>
                    </div>
                </div>
        </div>
    </main>
@endsection