<!-- jQuery -->
<script src="/template/user/plugins/jquery/jquery.min.js"></script>

<!-- userLTE App -->
<script src="/template/user/dist/js/adminlte.js"></script>

<script src="/template/user/js/validate.js"></script>
<script src="/template/user/plugins/bootstrap/bootstrap.bundle.js"></script>

<script src="/template/user/js/main.js"></script>

<script>
    $(() => {
        $('.close-alert').click(() => {
            $('.close-alert').parent().hide();
        })
    })
</script>
@yield('footer')
