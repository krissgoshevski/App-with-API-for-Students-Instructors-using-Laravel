@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in as Instructor!') }}
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center">
        <form action="" id="edit-user">
            <input type="text" id="name"/>
            <input type="email" id="email"/>
            <button id="update">Update</button>
        </form>
    </div>

</div>



<script>
 
 $(document).ready(function () {
    $.ajax({
        url: '/api/student/<?php echo $id; ?>',
        method: 'get',
        headers: {
            'Authorization': 'Bearer ' + $("meta[name='api_token']").attr('content')
        },
        success: function (data) {
            $('#name').val(data.name);
            $('#email').val(data.email);
        }
    });

    $('#update').on('click', function () {
        $.ajax({
            url: '/api/update/<?php echo $id; ?>',
            method: 'post',
            headers: {
                'Authorization': 'Bearer ' + $("meta[name='api_token']").attr('content')
            },
            data: {
                name: $('#name').val(),
                email: $('#email').val(),
                id: <?php echo $id; ?>,
            },
            success: function (data) {
                window.location = '/index';
            }
        });
    });
});



</script>
@endsection
