@extends('admin.adminLayout')
@section('content')
<main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Brands</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{route('userList')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Brands</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        All Brands
                        <a href="{{route('brands.create')}}" class="btn btn-outline-primary btn-sm float-end"> + Add Brand</a>
                    </div>
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

                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <!-- <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Contact</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                            </tfoot> -->
                            <tbody>
                            @foreach ($brands as $brand)
                            <tr>
                                <td>{{$brand->name}}</td>
                                <td>{{$brand->description}}</td>
                                <td><img src="{{asset($brand->image)}}" alt="Brand Image" height="50" width="50" class="rounded-circle"></td>
                                <td style="max-width: 30px">
                                    <a href="{{route('brands.edit',['brand'=>$brand->id])}}" class="btn btn-sm btn-warning">Edit</a> &nbsp;
                                    <a href="{{route('adminChangeBrandStatus',['id'=>$brand->id, 'status'=>$brand->is_active == 1 ? 0 : 1])}}" class="btn btn-sm btn-{{$brand->is_active == 1 ? 'danger':'success'}}">{{$brand->is_active == 1 ? 'Deactivate':'Activate'}}</a>
                                </td>
                            </tr>
                                
                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
@endsection