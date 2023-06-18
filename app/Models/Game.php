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
    
}
