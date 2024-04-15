<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['movies' => Movie::all()]);
    }

    /**
     * @param  MovieRequest  $movie_request
     *
     * @return JsonResponse
     */
    public function store(MovieRequest $movie_request): JsonResponse
    {
        $movie_request->validated();

        $poster = $movie_request->file('poster')->storeAs('images',
            $movie_request->file('poster')->getClientOriginalName(), 'public');

        $movie = Movie::create($movie_request->only('title', 'description') + ['poster' => $poster]);

        return response()->json([
            'message' => 'Movie created successfully',
            'movie'   => $movie
        ]);
    }
}
