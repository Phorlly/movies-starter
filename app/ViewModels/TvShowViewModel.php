<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tv;

    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    public function tv()
    {
        $key = $this->tv;
        return collect($key)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $key['poster_path'] ?? '500x750',
            'vote_average' => $key['vote_average'] * 10 . '%',
            'first_air_date' => formatedDate($key['first_air_date']),
            'genres' => collect($key['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($key['credits']['crew'])->take(2),
            'cast' => collect($this->tv['credits']['cast'])->take(5)->map(function ($param) {
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
            'name',
            'vote_average',
            'overview',
            'first_air_date',
            'credits',
            'videos',
            'images',
            'crew',
            'cast',
            'images',
            'created_by'
        ]);
    }
}
