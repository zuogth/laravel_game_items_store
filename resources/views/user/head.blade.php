<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{$title}}</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<!-- icheck bootstrap -->

<!-- Theme style -->
<link rel="stylesheet" href="/template/user/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/template/user/dist/css/adminlte.min.css">
<link rel="stylesheet" href="/template/user/dist/css/custom.css">
<link rel="stylesheet" href="/template/user/dist/css/home.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@yield('head')
