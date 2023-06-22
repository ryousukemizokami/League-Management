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
        
        //バリデーション
        $request->validate([
            'day' => 'required',
            'time' => 'required',
            'battleteam' => 'required|max:255',
            'place' => 'required|max:255',
        ]);
        
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
        $positions = Position::all();
        $users = $game->users()->whereIn('status', [1, 2])->get();
        $un_answered_users = $game->un_answered_users();
        return view('admin.games.show', compact('game', 'positions', 'users', 'un_answered_users'));
    }
    
    //試合更新画面表示処理
    public function edit(Request $request, $id)
    {
        $game = Game::find($id);
        return view('admin.games.edit', compact('game'));
    }
    
    //試合情報更新
    public function update(Request $request, $id)
    {
        
        //バリデーション
        $request->validate([
            'day' => 'required',
            'time' => 'required',
            'battleteam' => 'required|max:255',
            'place' => 'required|max:255',
        ]);
        
        //idの値で試合情報を取得
        $game = Game::find($id);
        
        $game->day = $request->day;
        $game->time = $request->time;
        $game->battleteam = $request->battleteam;
        $game->place = $request->place;
        $game->memo = $request->memo;
        $game->save();
        
        return redirect('/admin/games/' . $id);
    }
    
     //試合削除表示処理
    public function destroy(Request $request, $id)
    {
        $game = Game::find($id);
        
        $game->delete();
        
        return redirect('/admin/dashboard/');
    }
    
    
}
