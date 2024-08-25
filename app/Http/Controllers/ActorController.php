<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\ActorViewModel;
use App\ViewModels\ActorsViewModel;

class ActorController extends Controller
{
    public function all($page = 1)
    {
        abort_if($page > 500, 204);

        $popularActors = allContent('/person/popular?page=' . $page);
        $items = new ActorsViewModel($popularActors, $page);

        return view('pages.actors.index', $items);
    }
    public function one($id)
    {
        $actor = oneContent('/person/' . $id);
        $social = oneContent('/person/' . $id . '/external_ids');
        $credits = oneContent('/person/' . $id . '/combined_credits');
        $items = new ActorViewModel($actor, $social, $credits);

        return view('pages.actors.show', $items);
    }
}
