<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Position;
use App\Models\UserGame;

class Game extends Model
{
    use HasFactory;
    
    /**
     * この試合に回答した選手。（ Userモデルとの関係を定義）
     */
    public function users(){
        return $this->belongsToMany(User::class, 'user_games', 'game_id', 'user_id')->withTimestamps();
    }
     
    /**
     * この試合に出席する選手。（ Userモデルとの関係を定義）
     */
    public function is_present($userId){
        return $this->users()->where('user_id', $userId)->where('status', 1)->exists();
    }
    
    /**
     * この試合への出席が監督によって確定した選手。（ Userモデルとの関係を定義）
     */
    public function is_determined($userId){
        return $this->users()->where('user_id', $userId)->where('status', 2)->exists();
    }
    
    /**
     * この試合を欠席する選手。（ Userモデルとの関係を定義）
     */
    public function is_absent($userId){
        return $this->users()->where('user_id', $userId)->where('status', 99)->exists();
    }
    
    /**
     * 試合への参加する選手のstatusを取得。
     */
    
    public function mystatus(){
        $user_id = \Auth::id();
        $game_id = $this->id;
        $user_game = UserGame::where('user_id', $user_id)->where('game_id', $game_id)->get()->first();
        if($user_game != NULL){
            $status = $user_game->status;
            if($status == 1){
                return '参加申請中';
            }elseif($status == 99){
                return '不参加';
            }else{
                return 'ポジション決定済';
            }
        }else{
            return '未回答';
        }
        
    }
    
    /**
     * この試合に未回答の選手を取得。（ Userモデルとの関係を定義）
     */
    public function un_answered_users(){
        $answered_userIds = $this->users()->pluck('user_id')->all();
        return User::whereNotIn('id', $answered_userIds)->get();
    }
    
}
