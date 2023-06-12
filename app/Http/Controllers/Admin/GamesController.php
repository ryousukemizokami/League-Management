<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Position;
use App\Models\Game;
use Illuminate\Support\Facades\Hash;

class GamesController extends Controller
{
    //試合を作成
    public function create()
    {
        $game = new Game();
        return view('admin.games.create', compact('game'));
    }
    
    //試合を保存
    public function store(Request $request)
    {
        $game = new Game;
        $game->day = $request->day;
        $game->time = $request->time;
        $game->battleteam = $request->battleteam;
        $game->place = $request->place;
        $game->memo = $request->memo;
        $game->save();
        
        return redirect('admin/dashboard');
    }
    
    //試合詳細
    public function show(Request $request, $id)
    {
        $game = Game::find($id);
        return view('admin.games.show', compact('game'));
    }
}
