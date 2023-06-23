<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Position;
use App\Models\Game;
use App\Models\UserGame;
use Illuminate\Support\Facades\Hash;

class UserGamesController extends Controller
{
    //監督が選手の回答を確定させる
    public function update(Request $request, $id)
    {
        $user_game = UserGame::where('game_id', $id)->where('user_id', $request->user_id)->get()->first();
        $user_game->position_id = $request->position_id;
        $user_game->status = 2;
        $user_game->save();
        
        return redirect('/admin/games/' . $id);
    }
    
     //監督が確定した選手を修正する。
    public function reset(Request $request, $id)
    {
        $user_game = UserGame::where('game_id', $id)->where('user_id', $request->user_id)->get()->first();
        //dd($user_game);
        $user_game->status = 1;
        $user_game->save();
        
        return redirect('/admin/games/' . $id);
    }
}
