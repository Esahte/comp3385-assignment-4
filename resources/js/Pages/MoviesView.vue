<script setup>
import {ref, onMounted} from 'vue';

const movies = ref([]);

onMounted(async () => {
    await fetch('/api/v1/movies', {
        method: 'GET',
        headers: {'Accept': 'application/json', 'Authorization': 'Bearer ' + localStorage.getItem('token') }
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            movies.value = data.movies;
        })
        .catch((error) => console.error(error));
});
</script>

<template>
    <!--    loop over list of movies and display the poster as the background image, movie title, and movie description-->
    <div class="container">
        <h2 class="mb-5">Movies</h2>
        <div class="row gx-4 gy-5">
            <div class="card col-md-4" v-for="movie in movies" :key="movie.id">
                <div class="card-body" :style="{ backgroundImage: 'url(' + movie.poster + ')' }">
                    <h3>{{ movie.title }}</h3>
                    <p>{{ movie.description }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
