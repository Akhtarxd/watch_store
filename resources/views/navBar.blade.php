<nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">Watch Store</a>
        <!-- Links -->
        <ul class="navbar-nav">
            <li>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="cart.html" class="nav-link" style="margin-right: 15px">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    Cart</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle btn" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-right: 10px">
                    @guest
                        My Account
                    @else
                        {{auth()->user()->fname}}
                    @endguest
                </a>
                @guest
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
                        <li><a class="dropdown-item" href="{{route('register')}}">Register</a></li>
                    </ul>
                @else
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('userProfile')}}">My Profile</a></li>
                        <li><form method="POST"  action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form></li>
                    </ul>
                @endguest
            </li>
        </ul>
    </div>
</nav>