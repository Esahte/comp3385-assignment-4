<script setup>
const saveMovie = async () => {
    const formData = new FormData(document.getElementById('movieForm'));

    const response = await fetch('/api/v1/movies', {
        method: 'POST',
        headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + localStorage.getItem('token') },
        body: formData
    });

    const data = await response.json();
    console.log(data);
}
</script>

<template>
    <form id="movieForm" @submit.prevent="saveMovie" action="/api/v1/movies" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" aria-describedby="titleHelp" name="title">
            <div id="titleHelp" class="form-text">Enter the title of the movie</div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" rows="3" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="poster" class="form-label">Poster</label>
            <input type="file" class="form-control" id="poster" name="poster">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</template>

<style scoped>

</style>
