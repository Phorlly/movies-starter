<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie()
    {
        $key = $this->movie;
        return collect($key)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $key['poster_path'] ?? '500x750',
            'vote_average' => $key['vote_average'] * 10 . '%',
            'release_date' => formatedDate($key['release_date']),
            'genres' => collect($key['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($key['credits']['crew'])->take(2),
            'cast' => collect($this->movie['credits']['cast'])->take(5)->map(function ($param) {
                return collect($param)->merge([
                    'profile_path' => $param['profile_path']
                        ? 'https://image.tmdb.org/t/p/w300' . $param['profile_path']
                        : 'https://via.placeholder.com/300x450',
                ]);
            }),
            'images' => collect($key['images']['backdrops'])->take(10),
        ])->only([
            'poster_path',
            'id',
            'genres',
            'title',
            'vote_average',
            'overview',
            'release_date',
            'credits',
            'videos',
            'images',
            'crew',
            'cast',
            'images'
        ]);
    }
}
