<script setup>
import { useRouter } from "vue-router";

const router = useRouter();

const authorize = async () => {
    const formData = new FormData(document.getElementById('loginForm'));

    // get API token
    await fetch('/api/v1/login', {
        method: 'POST',
        headers: {
            'Accept': 'application/json'
        },
        body: formData
    }).then((response) => response.json())
        .then((data) => {
            localStorage.setItem('token', data.token)
            router.push('/movies');
        });
}
</script>

<template>
    <div class="container">
        <h2 class="mb-5">Login</h2>
        <form id="loginForm" @submit.prevent="authorize" action="/api/v1/login" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<style scoped>

</style>
