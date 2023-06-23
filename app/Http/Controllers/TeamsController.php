<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Position;
use Illuminate\Support\Facades\Hash;

class TeamsController extends Controller
{
    //選手の人数を取得
    public function index()
    {
        $count_user = User::count();
        //dd($count_user);
        return view('teams.index', compact('count_user'));
    }
    
}
