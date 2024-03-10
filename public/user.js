$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(e) { 
    $("#form_signup").submit(function(e) {
        e.preventDefault();
        signupUser();
    });

    $("#form_login").submit(function(e) {
        e.preventDefault();
        loginUser();
    });
});

function signupUser() {   
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: '/signup_user',
        data: {
        	name: $("#name").val(),
            email: $("#email").val(),
            password: $("#password").val()
        },
    }).done(function(result){
        alert(result.message);
        location.href = "/";
   	}).fail(function (data) {
        alert('ERROR: ' + JSON.parse(data['responseText']).message);
    }); 
}

function loginUser() {   
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: '/login_user',
        data: {
            email: $("#email").val(),
            password: $("#password").val()
        },
    }).done(function(result){
        alert(result.message);
        location.href = "/tasks";
   	}).fail(function (data) {
        alert('ERROR: ' + JSON.parse(data['responseText']).message);
    }); 
}
