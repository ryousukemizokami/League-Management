<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $games = Game::all();
        // 認証済みユーザを取得
        $user = \Auth::user();
        return view('dashboard',compact('games', 'user'));
    }
}
