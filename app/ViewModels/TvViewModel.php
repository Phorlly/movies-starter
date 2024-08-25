<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTv, $topRatedTv, $genres;
    public function __construct($popularTv, $topRatedTv, $genres)
    {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genres;
    }

    public function popularTv()
    {
        return $this->formatTv($this->popularTv);
    }

    public function topRatedTv()
    {
        return $this->formatTv($this->topRatedTv);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($key) {
            return [$key['id'] => $key['name']];
        });
    }

    private function formatTv($params)
    {
        return collect($params)->map(function ($param) {
            $genresFormatted = collect($param['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($param)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $param['poster_path'],
                'vote_average' => $param['vote_average'] * 10 . '%',
                'first_air_date' => formatedDate($param['first_air_date']),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path',
                'id',
                'genre_ids',
                'name',
                'vote_average',
                'overview',
                'first_air_date',
                'genres',
            ]);
        });
    }
}
