@extends('admin.adminLayout')
@section('content')
<main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Users</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{route('userList')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        All Users
                        <a href="{{route('adminRegisterUserProfile')}}" class="btn btn-outline-primary btn-sm float-end"> + Add User</a>
                    </div>
                    <div class="card-body">
                        @if(session()->has('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{session('error')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                            </div>
                        @endif
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Contact</th>
                                <th>Country</th>
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
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->full_name}}</td>
                                <td>{{$user->role_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->gender}}</td>
                                <td>{{$user->contact}}</td>
                                <td>{{$user->countryData->name}}</td>
                                <td style="max-width: 30px">
                                    <a href="{{route('editUser',['id'=>$user->id])}}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{route('adminChangeUserStatus',['id'=>$user->id, 'status'=>$user->is_active == 1 ? 0 : 1])}}" class="btn btn-sm btn-{{$user->is_active == 1 ? 'danger':'success'}}">{{$user->is_active == 1 ? 'Deactivate':'Activate'}}</a>
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