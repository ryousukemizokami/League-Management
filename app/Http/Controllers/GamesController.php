<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Position;
use App\Models\Game;
use Illuminate\Support\Facades\Hash;

class GamesController extends Controller
{
    //試合詳細
    public function show(Request $request, $id)
    {
        $game = Game::find($id);
        $positions = Position::all();
        $users = $game->users()->whereIn('status', [1, 2])->get();
        $un_answered_users = $game->un_answered_users();
        return view('games.show', compact('game', 'positions', 'users', 'un_answered_users'));
    }
}
