<!-- jQuery -->
<script src="/template/user/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/template/user/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="/template/user/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/template/user/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- userLTE App -->
<script src="/template/user/dist/js/adminlte.min.js"></script>
<script src="/template/user/plugins/datatables/intl.js"></script>
<script src="/template/user/js/main.js"></script>
<script src="/template/user/plugins/sweet/sweetalert2.all.min.js"></script>
<script>
    $(()=>{
        $('.close-alert').click(()=>{
            $('.close-alert').parent().hide();
        })
    })
</script>
@yield('footer')
