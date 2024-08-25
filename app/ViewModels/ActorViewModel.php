<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor, $social, $credits;
    public function __construct($actor, $social, $credits)
    {
        $this->actor = $actor;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function actor()
    {
        $key = $this->actor;
        return collect($key)->merge([
            'birthday' => formatedDate($key['birthday']),
            'age' => convertedAge($key['birthday']),
            'profile_path' => $key['profile_path']
                ? 'https://image.tmdb.org/t/p/w300/' . $key['profile_path']
                : 'https://via.placeholder.com/300x450',
        ])->only([
            'birthday',
            'age',
            'profile_path',
            'name',
            'id',
            'homepage',
            'place_of_birth',
            'biography'
        ]);
    }

    public function social()
    {
        $key = $this->social;
        return collect($key)->merge([
            'twitter' => 'https://twitter.com/' . $key['twitter_id'] ?? null,
            'facebook' =>  'https://facebook.com/' . $key['facebook_id'] ?? null,
            'instagram' => 'https://instagram.com/' . $key['instagram_id'] ?? null,
        ])->only([
            'facebook',
            'instagram',
            'twitter',
        ]);
    }

    public function knownForMovies()
    {
        $key = collect($this->credits)->get('cast');
        return collect($key)->sortByDesc('popularity')->take(5)->map(function ($param) {
            if (isset($param['title'])) {
                $title = $param['title'];   
            } elseif (isset($param['name'])) {
                $title = $param['name'];
            } else {
                $title = 'Untitled';
            }

            return collect($param)->merge([
                'poster_path' => $param['poster_path']
                    ? 'https://image.tmdb.org/t/p/w185' . $param['poster_path']
                    : 'https://via.placeholder.com/185x278',
                'title' => $title,
                'linkToPage' => $param['media_type'] === 'movie'
                    ? route('movie.one', $param['id'])
                    : route('tv.one', $param['id'])
            ])->only([
                'poster_path',
                'title',
                'id',
                'media_type',
                'linkToPage',
            ]);
        });
    }

    public function credits()
    {
        $key = collect($this->credits)->get('cast');
        return collect($key)->map(function ($param) {
            if (isset($param['release_date'])) {
                $releaseDate = $param['release_date'];
            } elseif (isset($param['first_air_date'])) {
                $releaseDate = $param['first_air_date'];
            } else {
                $releaseDate = '';
            }

            if (isset($param['title'])) {
                $title = $param['title'];
            } elseif (isset($param['name'])) {
                $title = $param['name'];
            } else {
                $title = 'Untitled';
            }

            return collect($param)->merge([
                'release_date' => $releaseDate,
                'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                'title' => $title,
                'character' => isset($param['character']) ? $param['character'] : '',
                'linkToPage' => $param['media_type'] === 'movie'
                    ? route('movie.one', $param['id'])
                    : route('tv.one', $param['id']),
            ])->only([
                'release_date',
                'release_year',
                'title',
                'character',
                'linkToPage',
            ]);
        })->sortByDesc('release_date');
    }
}
