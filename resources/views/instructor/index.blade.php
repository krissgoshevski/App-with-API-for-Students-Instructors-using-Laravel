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
        <input type="text" id="search" name="search"/>
    </div>

    <div class="row justify-content-center my-5">
        <a href="{{ route('student.create') }}" class="btn btn-primary">Create Student</a>
    </div>


    <div class="row justify-content-center">
<!-- treba da gi zememe userito so API ruti -->

<table class="table table-sm" id="users">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
     
    </tbody>
</table>


    </div>
</div>



<script>
    // keyup koga ke se iskkuca nekoja vrednost 
$('#search').on('keyup', function () {
   
    $.ajax({
        url: 'api/search',
        method: 'POST',
        headers: {
            'Authorization': 'Bearer ' + $("meta[name='api_token']").attr('content')
        },
        data: {
            search: $(this).val()
        },
        success: function(users) {
            appendUsers(users);
        }
    })
})

 function getUsers()
 {
    $.ajax({
        url: 'api/users',
        method: 'get',
        headers: {
            'Authorization': 'Bearer ' + $("meta[name='api_token']").attr('content')
        },
        success: function (users) {
            console.log(users);
            appendUsers(users);
        }
    });
 }
 $(document).ready(function () {
    getUsers();
});


function appendUsers(users) {
    $('#users tbody').html('');

    users.forEach(user => {
        $('#users tbody').append(
            `<tr data-user_id='${user.id}'> 
                <td>${user.id}</td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.role.name}</td>
                <td>${createActionButtons(user)}</td>
            </tr>`
        );
    });
}

function createActionButtons(user) 
{
    let buttons = '';

    if (user.role.id == 2) {
        buttons +=
            `
            <a class='btn btn-warning' href='/edit/${user.id}'>EDIT</a>
            <button class='delete-btn btn btn-danger' data-id='${user.id}'>DELETE</button>
            <a class='btn btn-warning' href=''>CREATE</a>
            `;
    }

    return buttons;
}


$(document).on('click', '.delete-btn', function(e) {
    e.preventDefault();
    let _this = $(this); // resenie 1 

    $.ajax({
        url: '/api/delete/' + $(this).data('id'),
        method: 'POST',
        headers: {
            'Authorization': 'Bearer ' + $("meta[name='api_token']").attr('content')
        },
        success: function(data) {
           // console.log(data);
           // _this.parent().parent().remove(); // resenie 1
           getUsers(); 
        }

    })
})

</script>
@endsection
