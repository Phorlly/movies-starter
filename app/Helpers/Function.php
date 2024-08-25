<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

function allContent(string $path, string $index = 'results')
{
    return Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url') . $path)->json()[$index];
}

function oneContent(string $path)
{
    return Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url') . $path)->json();
}

function formatedDate($date)
{
    return Carbon::parse($date)->setTimezone('Asia/Bangkok')->format('d M Y');
}

function convertedAge($date)
{
    return Carbon::parse($date)->age;
}

function isActive($path, $segment = 1)
{
    if (Request::segment($segment) == 'movie' && $path == '') {
        $path = 'movie';
    }

    if (Request::segment($segment) == $path) {
        return 'hover:text-gray-300 bg-blue-500 text-white font-semibold py-2 rounded-b-sm px-4 rounded-t-2xl';
    } else {
        return 'text-gray-300 hover:text-gray-600';
    }
}
