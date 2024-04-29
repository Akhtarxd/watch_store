@extends('admin.adminLayout')
@section('content')
<div class="container h-100" >
    <div class="container-xl px-4 mt-4">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <!-- Account page navigation-->
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header"><h5>Brand Image</h5></div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <form action="{{route('adminChangeBrandImage',['id' => $brand->id])}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <img class="img-account-profile rounded-circle mb-2"
                             src="{{ asset($brand->image) }}" alt="User profile" width="350" height="350">
                            
                             <input type="file" class="form-control" id="image" name="image" placeholder="Brand image">
                                
                            <!-- Profile picture upload button-->
                            <button class="btn btn-outline-primary" type="submit" name="updateImage" id="updateImage" value="Update profile image">Upload New Image</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header"><h5>Brand Details</h5></div>
                    <div class="card-body">
                        <form method="POST" action="{{route('brands.update',['brand' => $brand->id])}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Brand name" value="{{$brand->name}}"
                                           >
                                </div>
                                
                            </div>
                            
                            
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" rows="3" name="description"
                                              placeholder="description">{{$brand->description}}</textarea>
                                </div>
                                
                            </div>
                            <br>
                            <div class="mb-3">
                                <input type="submit" name="update" id="update" value="Update Profile"
                                       class="btn btn-outline-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection