<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowViewModel;
use Illuminate\Http\Request;
use App\ViewModels\TvViewModel;

class TvController extends Controller
{
    public function all()
    {
        $popularTv = allContent('/tv/popular');
        $topRatedTv = allContent('/tv/top_rated');
        $genres = collect(allContent('/genre/tv/list', 'genres'));
        $viewModel = new TvViewModel($popularTv, $topRatedTv, $genres);

        return view('pages.tv.index', $viewModel);
    }
    public function one($id)
    {
        $tv = oneContent('/tv/' . $id . '?append_to_response=credits,videos,images');
        $viewModel = new TvShowViewModel($tv);

        return view('pages.tv.show', $viewModel);
    }
}
