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

const getCardStyle = (poster) => {
    return {
        backgroundImage: `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(http://localhost:8000/storage/${poster})`,
        backgroundSize: 'cover !important',
        backgroundClip: 'border-box !important',
        color: 'white !important',
        position: 'relative !important',
        zIndex: '2 !important'
    };
};
</script>

<style scoped>
#custom-card {
    height: 100%;
    position: relative;
}

#custom-card::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: inherit;
    z-index: 1;
}
</style>

<template>
    <div class="container">
        <h2 class="mb-5">Movies</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col d-flex" v-for="movie in movies" :key="movie.id">
                <div class="card" id="custom-card">
                    <div class="card-body" :style="getCardStyle(movie.poster)">
                        <h3>{{ movie.title }}</h3>
                        <p>{{ movie.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
