<?php

namespace App\Http\Controllers;

use App\Models\Ui;
use App\Models\Game;
use App\Models\Video;
use App\Models\Desain;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function design()
    {
        $desains = Desain::latest()->get();
        return view('design.index', compact('desains'));
    }

    public function video()
    {
        $videos = Video::latest()->get();
        return view('video.index', compact('videos'));
    }

    public function game()
    {
        $games = Game::latest()->get();
        return view('game.index', compact('games'));
    }

    public function ui()
    {
        $uis = Ui::latest()->get();
        return view('ui.index', compact('uis'));
    }
}
