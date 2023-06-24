<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Position;
use App\Models\Game;
use App\Models\UserGame;
use Illuminate\Support\Facades\Hash;

class UserGamesController extends Controller
{
    //出欠の回答を保存
    public function store(Request $request, $gameId)
    {
        $user = \Auth::user();
        $user->submit($gameId, $user->position->id, $request->status);
        return redirect('/games/' . $gameId);
    }
    
     //選手が回答を修正する。(user_gamesテーブルから削除する。)
    public function destroy(Request $request, $id)
    {
        $user_game = UserGame::where('game_id', $id)->where('user_id', $request->user_id)->get()->first();
        //dd($user_game);
        $user_game->delete();
        
        return redirect('/games/' . $id);
    }
}
