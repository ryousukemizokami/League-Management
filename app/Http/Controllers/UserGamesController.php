<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Position;
use App\Models\Game;
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
}
