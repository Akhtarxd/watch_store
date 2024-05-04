@extends('admin.adminLayout')
@section('content')
<main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Orders</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{route('userList')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">orders</li>
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

                        <table class="table" id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>User Name</th>
                                <th>Sub Total</th>
                                <th>Shipping</th>
                                <th>Tax rate</th>
                                <th>Tax Amount</th>
                                <th>Amount</th>
                                <th>Comment</th>
                                <th>Status</th>
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
                            @foreach ($orders as $order)
                            <tr>
                                <td>WT-{{ $order->id }}</td>
                                <td>{{ $order->customerData->full_name }}</td>
                                <td>{{ $order->sub_total }}</td>
                                <td>{{ $order->shipping }}</td>
                                <td>{{ $order->tax_rate }}</td>
                                <td>{{ $order->tax_amount }}</td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->comment }}</td>
                                <td>{{ $order->status }}</td>
                                <td><form method="post" action="{{route('changeOrderStatus',['id'=>$order->id])}}">
                                    @csrf
                                    <select class="form-select" name="orderStatus" id="orderStatus" aria-label="Default select example">
                                        <option selected disabled>Select</option>
                                        @foreach (\Illuminate\Support\Facades\Config::get('orderStatus') as $status)
                                        <option value="{{ $status }}" @if($status == $order->status ) {{'selected'}}@endif>{{ $status }}</option>
                                            
                                        @endforeach
                                    </select>
                                    <input type="submit" class="btn btn-sm btn-primary" value="Update Status">
                                </form>
                            <a href="{{ route('getLineItems',['id'=>$order->id]) }}" class="btn btn-warning">View</a>
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