<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{

    public function all()
    {
        $popularMovies = allContent('/movie/popular');
        $nowPlayingMovies = allContent('/movie/now_playing');
        $genres = collect(allContent('/genre/movie/list', 'genres'));
        $viewModel = new MoviesViewModel($popularMovies, $nowPlayingMovies, $genres);

        return view('pages.movies.index', $viewModel);
    }

    public function one($id)
    {
        $movie = oneContent('/movie/' . $id . '?append_to_response=credits,videos,images');
        $viewModel = new MovieViewModel($movie);

        return view('pages.movies.show', $viewModel);
    }
}
