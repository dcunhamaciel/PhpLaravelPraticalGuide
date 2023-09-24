<template>
    <form @submit.prevent="submit" class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Please Register</h1>        
        <input v-model="firstName" type="text" class="form-control" placeholder="First Name" required autofocus>
        <input v-model="lastName" type="text" class="form-control" placeholder="Last Name" required>
        <input v-model="email" type="email" class="form-control" placeholder="Email address" required>        
        <input v-model="password" type="password" class="form-control" placeholder="Password" required>
        <input v-model="passwordConfirm" type="password" class="form-control" placeholder="Password Confirm" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
    </form>
</template>

<script lang="ts">
import { ref } from 'vue';

export default {
    name: 'RegisterComponent',
    setup() {
        const firstName = ref('')
        const lastName = ref('')
        const email = ref('')
        const password = ref('')
        const passwordConfirm = ref('')

        const submit = () => {
            console.log({
                first_name: firstName.value,
                last_name: lastName.value,
                email: email.value,                
                password: password.value,
                password_confirm: passwordConfirm.value
            })
        }

        return {
            firstName,
            lastName,
            email,
            password,
            passwordConfirm,
            submit
        }
    }
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