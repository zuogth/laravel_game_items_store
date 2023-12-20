{{--@if($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--            @foreach($errors->all() as $error)--}}
{{--                {{$error}}--}}
{{--            @endforeach--}}
{{--    </div>--}}
{{--@endif--}}

@if(Session::has('error'))
    <div class="alert-noti alert alert-warning">
        <i class="fas fa-times close-alert"></i>
        <span>{{Session::get('error')}}</span>
    </div>
    <script>
        // Add a timeout to close the alert after 5000 milliseconds (5 seconds)
        setTimeout(function () {
            closeAlert('.alert-warning');
        }, 5000);

        // Function to close the alert
        function closeAlert(alertId) {
            $(alertId).hide();
        }
    </script>
@endif

@if(Session::has('success'))
    <div class="alert-noti alert alert-success">
        <i class="fas fa-times close-alert"></i>
        <span>{{Session::get('success')}}</span>
    </div>
    <script>
        // Add a timeout to close the alert after 5000 milliseconds (5 seconds)
        setTimeout(function () {
            closeAlert('.alert-success');
        }, 5000);

        // Function to close the alert
        function closeAlert(alertId) {
            $(alertId).hide();
        }
    </script>
@endif

