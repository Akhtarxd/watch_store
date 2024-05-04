@extends('layoutUser')
@section('content')
<div class="container h-100" style="margin: 7% 0% 7% 15%;">
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
                    <div class="card-header"><h5>Profile Picture</h5></div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <form action="{{route('userProfileImageUpdate')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <img class="img-account-profile rounded-circle mb-2"
                             src="{{$user->profile}}" alt="User profile" width="350" height="350">
                            
                             <input type="file" class="form-control" id="profile" name="profile" placeholder="Profile picture">
                                
                            <!-- Profile picture upload button-->
                            <button class="btn btn-outline-primary" type="submit" name="updateImage" id="updateImage" value="Update profile image">Upload New Image</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header"><h5>Account Details</h5></div>
                    <div class="card-body">
                        <form method="POST" action="{{route('updateUserProfile')}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname"
                                           placeholder="First name" value="{{$user->fname}}"
                                           >
                                </div>
                                <div class="col">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname"
                                           placeholder="Last name" value="{{$user->lname}}"
                                           >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}"
                                           placeholder="name@example.com" >
                                </div>
                                <div class="col">
                                    <label for="mobile" class="form-label">Contact Number</label>
                                    <input type="tel" class="form-control" id="contact" name="contact"
                                           placeholder="1234567890" value="{{$user->contact}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <!-- <label for="password" class="form-label">Password</label><br>
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="password" required="">
                                </div> -->
                                <div class="col">
                                    <label for="gender" class="form-label">Gender</label><br>
                                    <input type="radio" id="gender" name="gender" value="Male" @if ($user->gender == 'Male') {{'checked'}}
                                        
                                    @endif>&nbsp;&nbsp;Male&nbsp;&nbsp;
                                    <input type="radio" id="gender" name="gender" value="Female" @if ($user->gender == 'Female') {{'checked'}}
                                        
                                        @endif>&nbsp;&nbsp;Female
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" rows="3" name="address"
                                              placeholder="address">{{$user->address}}</textarea>
                                </div>
                                <div class="col">
                                    <label for="inputCountry" class="form-label">Country</label>
                                    <select class="form-select" id="inputCountry" name="country"
                                            aria-label="Default select example"
                                            required="" >
                                        <option selected disabled>Select</option>
                                        @foreach ($countries as $country)
                                            <option value="{{$country->id}}" @if ($user->country==$country->id){{'selected'}}  @endif >{{$country->name}}</option>
                                        @endforeach

                                    </select>
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
        <!-- Orders Section -->
        <div class="row">
            <div class="col-xl">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header"><h5>My Orders</h5></div>
                    <div class="card-body text-center">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Date</th>
                                <th scope="col">Price</th>
                                <th scope="col">Shipping Charge</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($lineItems as $lineItem)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{$lineItem->productData->name}}</td>
                                <td>{{$lineItem->created_at}}</td>
                                <td>{{$lineItem->price}}</td>
                                <td>₹{{$lineItem->orderData->shipping}}</td>
                                <td>{{$lineItem->quantity}}</td>
                                <td>{{$lineItem->total_price}}</td>
                                <td>{{$lineItem->orderData->status}}</td>
                            </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection