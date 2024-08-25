<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies, $genres, $nowPlayingMovies;

    public function __construct($popularMovies, $nowPlayingMovies, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres = $genres;
    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }

    public function nowPlayingMovies()
    {
        return $this->formatMovies($this->nowPlayingMovies);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($key) {
            return [$key['id'] => $key['name']];
        });
    }

    private function formatMovies($params)
    {
        return collect($params)->map(function ($key) {
            $genresFormated = collect($key['genre_ids'])->mapWithKeys(function ($val) {
                return [$val => $this->genres()->get($val)];
            })->implode(', ');

            return collect($key)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500' . $key['poster_path'],
                'vote_average' => $key['vote_average'] * 10 . '%',
                'release_date' => formatedDate($key['release_date']),
                'genres' => $genresFormated,
            ])->only([
                'id',
                'title',
                'poster_path',
                'vote_average',
                'release_date',
                'genres',
                'overview',
                'genre_ids',
            ]);
        });
    }
}
