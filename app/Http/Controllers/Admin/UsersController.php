<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Position;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //メンバー一覧を取得
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    
    //選手を作成
    public function create()
    {
        //全ポジションを取得
        $positions = Position::all();
        $user = new User();
        
        return view('admin.users.create', compact('positions', 'user'));
    }
    
    //選手を保存
    public function store(Request $request)
    {
        
        //バリデーション
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'position_id' => 'required|max:255',
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->birthday = $request->birthday;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->position_id = $request->position_id;
        $user->save();
        
        return redirect('admin/dashboard');
    }
    
    //選手詳細
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        $un_answered_games = $user->un_answered_games();
        return view('admin.users.show', compact('user', 'un_answered_games'));
    }
    
     //選手削除表示処理
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        
        $user->delete();
        
        return redirect('/admin/users/');
    }
}
