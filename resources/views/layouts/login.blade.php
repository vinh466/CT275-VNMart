<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>VNMart - @yield('title')</title>
    <link rel="shortcut icon" href="/img/LogoBrowser.png">
    <!-- Custom fonts for this template-->
    <link href="/font/awesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="/font/nunito/all.css"rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/plugins/sb-admin-2/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/Account/custom.css">
    <link rel="stylesheet" href="/css/Account/account.css">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        @yield('content')

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/plugins/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/plugins/sb-admin-2/sb-admin-2.min.js"></script>
    <script src="/plugins/jquery-validation.js"></script>
    @yield('script')
</body>

</html>