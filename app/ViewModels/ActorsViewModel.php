<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    public $popularActors, $page;
    public function __construct($popularActors, $page)
    {
        $this->popularActors = $popularActors;
        $this->page = $page;
    }

    public function popularActors()
    {
        return collect($this->popularActors)->map(function ($key) {
            return collect($key)->merge([
                'profile_path' =>  $key['profile_path']
                    ? 'https://image.tmdb.org/t/p/w235_and_h235_face' . $key['profile_path']
                    : 'https://ui-avatars.com/api/?size=235&name=' . $key['name'],
                'known_for' => collect($key['known_for'])->where('media_type', 'movie')->pluck('title')
                    ->union(collect($key['known_for'])->where('media_type', 'tv')->pluck('name'))->implode(', '),
            ])->only([
                'id',
                'name',
                'profile_path',
                'known_for'
            ]);
        });
    }

    public function back()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < 500 ? $this->page + 1 : null;
    }
}
