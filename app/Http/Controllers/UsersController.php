<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Position;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //選手一覧を取得
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    
    //選手詳細
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        $un_answered_games = $user->un_answered_games();
        return view('users.show', compact('user', 'un_answered_games'));
    }
    
    //プロフィール更新画面表示処理
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }
    
    //プロフィール更新
    public function update(Request $request, $id)
    {
        
        //バリデーション
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'max:255',
        ]);
        
        //idの値でログイン中のユーザーを取得
        $user = User::find($id);
        
        //セットした画像の取得
        $file = $request->image;
        
        if ($file)
        {
            //ランダムなファイル名を作成
            $image = time() . $file->getClientOriginalName();
            //アップロードするフォルダを取得
            $target_path = public_path('uploads');
            //アップロード処理
            $file->move($target_path, $image);
        }else{
            $image = '';
        }
        
        $user->name = $request->name;
        $user->birthday = $request->birthday;
        $user->image = $image;
        $user->save();
        
        return redirect('dashboard');
    }
}
