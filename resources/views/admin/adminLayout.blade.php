<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Dashboard - Watch Store Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet"/>
    <link href="{{asset('admin_assets/css/styles.css')}}" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
            crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    @include('admin.layoutPartials.navBar')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('admin.layoutPartials.sideBar')
        </div>
        
        <div id="layoutSidenav_content">
            @yield('content')
            @include('admin.layoutPartials.footerMain')
        </div>
    </div>
    @include('admin.layoutPartials.footerScript')

</body>
</html>