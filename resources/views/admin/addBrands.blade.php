@extends('admin.adminLayout')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Users</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('brands.index')}}"> List</a></li>
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
                        <form method="POST" action="{{route('brands.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Brand name"
                                       required="">
                            </div>
                            
                        </div>
                        
                        
                        <div class="row mb-3">
                            <div class="col">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description"
                                          placeholder="Description" required=""></textarea>
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="image" class="form-label">Image</label><br>
                                <input type="file" class="form-control-file" name="image" id="image">
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