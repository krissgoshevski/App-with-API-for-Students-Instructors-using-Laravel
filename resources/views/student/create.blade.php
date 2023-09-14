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
        <form id="add-user">
         <p> <input type="text" name="name" id="name" placeholder="enter a name"/> </p>  
         <p> <input type="email" name="email" id="email" placeholder="enter an email"/> </p>  
         <p> <input type="password" name="password" id="password" placeholder="enter a password"/> </p>  
         <p> <input type="password" name="password_confirmation" id="password_confirmation" placeholder="enter a password"/> </p>  

<button id="create">Create</button>

        </form>
    </div>
</div>
<script>
    $('#create').on('click', function(e) {
        e.preventDefault();

        $.ajax({
            url: '/api/student/create',
            type: 'post',
            headers: {
                'Authorization': 'Bearer ' + $("meta[name='api_token']").attr('content')
            },
            data: $('#add-user').serialize(),
            success: function (data) {
                window.location = '/index';
            }



        })


    })

</script>
@endsection
