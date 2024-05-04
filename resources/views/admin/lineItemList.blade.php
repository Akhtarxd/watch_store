@extends('admin.adminLayout')
@section('content')
<main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Line Items</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{route('userList')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">lineitems</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        All line items
                        <a href="{{route('product.create')}}" class="btn btn-outline-primary btn-sm float-end"> + Add Product</a>
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
                                <th>Order id</th>
                                <th>User Name</th>
                                <th>Product name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                                
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
                            @foreach ($requestData->lineItemsData as $lineItemData)
                            <tr>
                                <td>WT-{{$lineItemData->order_id}}</td>
                                <td>{{$lineItemData->customerData->fname}}</td>
                                <td>{{$lineItemData->productData->name}}</td>
                                <td>{{$lineItemData->quantity}}</td>
                                <td>{{$lineItemData->price}}</td>
                                <td>{{$lineItemData->total_price}}</td>
                                <td style="max-width: 30px">
                                
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