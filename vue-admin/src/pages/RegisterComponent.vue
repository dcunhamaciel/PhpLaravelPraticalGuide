<template>
    <form class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Please Register</h1>        
        <input type="text" class="form-control" placeholder="First Name" required autofocus>
        <input type="text" class="form-control" placeholder="Last Name" required>
        <input type="email" class="form-control" placeholder="Email address" required>        
        <input type="password" class="form-control" placeholder="Password" required>
        <input type="password" class="form-control" placeholder="Password Confirm" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
    </form>
</template>

<script>
import { ref } from 'vue';

export default {
    name: 'RegisterComponent'
}
</script>

<style scoped>
html,
body {
height: 100%;
}

body {
display: -ms-flexbox;
display: -webkit-box;
display: flex;
-ms-flex-align: center;
-ms-flex-pack: center;
-webkit-box-align: center;
align-items: center;
-webkit-box-pack: center;
justify-content: center;
padding-top: 40px;
padding-bottom: 40px;
background-color: #f5f5f5;
}

.form-signin {
width: 100%;
max-width: 330px;
padding: 15px;
margin: 0 auto;
}
.form-signin .checkbox {
font-weight: 400;
}
.form-signin .form-control {
position: relative;
box-sizing: border-box;
height: auto;
padding: 10px;
font-size: 16px;
}
.form-signin .form-control:focus {
z-index: 2;
}
.form-signin input[type="email"] {
margin-bottom: -1px;
border-bottom-right-radius: 0;
border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
margin-bottom: 10px;
border-top-left-radius: 0;
border-top-right-radius: 0;
}
</style>