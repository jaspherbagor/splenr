@extends('layouts.app')

@section('content')
<style>
    * {
        padding:0;
        margin:0;
        box-sizing: border-box;
        list-style:none;
        text-decoration: none;
        border:none;
        outline:none;
        scroll-behavior: smooth;
        font-family:var(--font-family);
        word-wrap: break-word;
    }
    html, body {
        width:100%;
        overflow-x:hidden
    }

    /* Heading 2 & Heading 1 Spacing */
    h2, h1 {
        word-spacing: 10px;
        letter-spacing: 5px;
    }

    /* Paragraph Line Height */
    p {
        line-height: 30px;
    }
    :root {
        --primary-color: #fdd100;
        --navbar-bg: #F5F4F2;
        --text-color-light: #ffffff;
        --text-color-dark: #202020;
        --font-family: sans-serif;
    }

    .register-container {
        background: url('https://images.pexels.com/photos/236089/pexels-photo-236089.jpeg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        min-height: 100vh;
    }

    .input-group-addon i {
        margin-left: -37px;
        cursor: pointer;
        z-index: 200;
        color:var(--text-color-dark)
    }

    .logo-img {
        height:90px
    }

    input {
        border: 2px solid var(--text-color-dark) !important;
    }

    .form-container {
        border-radius:10px;
        background: rgba(200, 200, 200, 0.9);
        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        width: 400px
    }

    .register-btn {
        background:var(--primary-color);
        border: 2px solid var(--text-color-dark)
      }

      .register-btn:hover{
        background:var(--text-color-dark);
        border: 2px solid var(--primary-color);
        color:var(--text-color-light)!important
      }
    
</style>
<div class="register-container container-fluid d-flex align-items-center justify-content-center px-2 py-5 mt-5">
    <div class="g-3 needs-validation form-container p-3 mt-5 h-auto">
        <div class="text-center">
            <a href="/">
                <img src="{{ asset('image/login-logo.svg') }}" class="logo-img"/>
            </a>
            
        </div>
        <h2 class="my-4 text-center fw-bolder heading">Employer Registration</h2>
        @include('message')
        <div id="message"></div>
        <div class="form-container-div" id="formContainer">
            <form action="#" method="post" id="registrationForm">@csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name">Company Name</label>
                        <input type="text" name="name" class="form-control">
                        @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control">
                        @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="col-md-12">
                            <label for="password" class="form-label">Password</label>
                            <div class="d-flex">
                                <input type="password" name="password" class="form-control" id="password">
                                <span class="input-group-addon" id="togglePassword">
                                    <i class="bi bi-eye position-absolute fs-4 mt-1" ></i>
                                </span>   
                            </div>
                            @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif             
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="col-md-12 mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <div class="d-flex">
                                <input type="password" name="confirmPassword" class="form-control" id="confirmPassword">
                                <span class="input-group-addon" id="toggleConfirmPassword">
                                    <i class="bi bi-eye position-absolute fs-4 mt-1" ></i>
                                </span>   
                            </div>
                            <span class="text-danger" id="confirmPasswordValidation"></span>           
                        </div>
                    </div>
                </div>
                <div class="text-center mt-2 mb-2">
                    <button class="btn fs-5 fw-semibold px-3 py-2 register-btn" type="submit" id="btnRegister">Register</button>
                </div>
            </form>
        </div>
        
    </div>
</div>

<script>
    const password = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    togglePassword.addEventListener('click', function() {
        if(password.type === "password"){
            password.type = "text";
            togglePassword.innerHTML=`<i class="bi bi-eye-slash position-absolute fs-4 mt-1" ></i>`;
        } else {
            password.type = "password";
            togglePassword.innerHTML=`<i class="bi bi-eye position-absolute fs-4 mt-1" ></i>`;
        }
    })

    const confirmPassword = document.getElementById('confirmPassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    toggleConfirmPassword.addEventListener('click', function() {
        if(confirmPassword.type === "password"){
        confirmPassword.type = "text";
        toggleConfirmPassword.innerHTML=`<i class="bi bi-eye-slash position-absolute fs-4 mt-1" ></i>`;
        } else {
            confirmPassword.type = "password";
            toggleConfirmPassword.innerHTML=`<i class="bi bi-eye position-absolute fs-4 mt-1" ></i>`;
        }
    })

    
    const passwordValidation = document.getElementById('confirmPasswordValidation');
    var url = "{{route('store.employer')}}";
    document.getElementById("btnRegister").addEventListener("click", function(event) {
    var form = document.getElementById("registrationForm");
    var formContainer = document.getElementById("formContainer");
    var messageDiv = document.getElementById('message')
    messageDiv.innerHTML = ''
    
    
    if(password.value !== confirmPassword.value) {
        passwordValidation.innerText="Passwords do not match!";
    } else if {
        (password.value ==="" && confirmPassword.value === "") {
        passwordValidation.innerText="No Passwords Inputted!";
    }else {
        var formData = new FormData(form)
        var button = event.target
        button.disabled = true;
        button.innerHTML = 'Sending email.... '
        fetch(url, {
        method: "POST",
        headers:{
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        body: formData
    }).then(response => {
        if(response.ok) {
            return response.json();
        }else{
            throw new Error('Error')
        }
    }).then(data => {
        button.innerHTML = 'Register'
        button.disabled = false
        messageDiv.innerHTML = '<div class="alert alert-success">Registration was successful.Please check your email to verify it</div>'
        formContainer.style.display = 'none'
    }).catch(error => {
        button.innerHTML = 'Register'
        button.disabled = false
        messageDiv.innerHTML = '<div class="alert alert-danger">Something went wrong. Please try again</div>'    
    })
    }
    
})
   
</script>
{{-- <div class="container px-4 py-5">
    <div class="row mt-5">
        <div class="col-md-6">
            <h1>Looking for an employee?</h1>
            <h3>Please create an account</h3>
            <img src="{{ asset('image/register.png') }}" class="w-25">
        </div>
        <div class="col-md-6">
            <div id="message"></div>
            <div class="card"  id="card">
                <div class="card-header">Employer Registration</div>
                <form action="#" method="post" id="registrationForm">@csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" name="name" class="form-control" required>
                            @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" required>
                            @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" required>
                            @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary" id="btnRegister">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var url = "{{route('store.employer')}}";
    document.getElementById("btnRegister").addEventListener("click", function(event) {
    var form = document.getElementById("registrationForm");
    var card = document.getElementById("card");
    var messageDiv = document.getElementById('message')
    messageDiv.innerHTML = ''
    var formData = new FormData(form)

    var button = event.target
    button.disabled = true;
    button.innerHTML = 'Sending email.... '

    fetch(url, {
        method: "POST",
        headers:{
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        body: formData
    }).then(response => {
        if(response.ok) {
            return response.json();
        }else{
            throw new Error('Error')
        }
    }).then(data=> {
        button.innerHTML = 'Register'
        button.disabled = false
        messageDiv.innerHTML = '<div class="alert alert-success">Registration was successful.Please check your email to verify it</div>'
        card.style.display = 'none'
    }).catch(error => {
        button.innerHTML = 'Register'
        button.disabled = false
        messageDiv.innerHTML = '<div class="alert alert-danger">Something went wrong. Please try again</div>'
       
    })


})
</script> --}}

@endsection