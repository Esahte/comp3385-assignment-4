<script setup>
import {onMounted, ref} from 'vue';
import { useRouter } from "vue-router";

const router = useRouter();
const isLoggedIn = ref(false);

onMounted(() => {
    if (localStorage.getItem('token')) {
        isLoggedIn.value = true;
    }
});

const logout = () => {
    fetch('/api/v1/logout', {
        method: 'POST',
        headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token'), 'Accept': 'application/json' }
    }).then(response => response.json())
        .then(data => {
            console.log(data);
            localStorage.removeItem('token');
            isLoggedIn.value = false;
            router.push('/');
        }).catch(error => console.error(error));
};
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">COMP3385</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <RouterLink class="nav-link" :class="{ active: $route.path === '/'}" to="/">Home</RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink class="nav-link" :class="{ active: $route.path === '/about'}" to="/about">About
                        </RouterLink>
                    </li>
                    <li class="nav-item" v-if="!isLoggedIn">
                        <RouterLink class="nav-link" :class="{ active: $route.path === '/login'}" to="/login">Login
                        </RouterLink>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <RouterLink class="nav-link" :class="{ active: $route.path === '/logout'}" to="/logout"
                                    @click.prevent="logout">Logout
                        </RouterLink>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <RouterLink class="nav-link" :class="{ active: $route.path === '/movies/create'}"
                                    to="/movies/create">Add Movie
                        </RouterLink>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <RouterLink class="nav-link" :class="{ active: $route.path === '/movies'}" to="/movies">Movies
                        </RouterLink>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>
