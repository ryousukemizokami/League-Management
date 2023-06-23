<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Position;
use App\Models\Game;
use App\Models\UserGame;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'position_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * この選手のポジション。（ Positionモデルとの関係を定義）
     */
     public function position(){
         return $this->belongsTo(Position::class);
     }
     
     /**
     * この選手が回答した試合。（ Gameモデルとの関係を定義）
     */
     public function games(){
         return $this->belongsToMany(Game::class, 'user_games', 'user_id', 'game_id')->withTimestamps();
     }
     
     /**
     * $gameIdで指定された試合の出欠を回答する。
     *
     * @param  int  $gameId
     * @return bool
     */
     public function submit($gameId, $positionId, $status)
    {
        $exist = $this->is_submitting($gameId);
        
        if($exist){
            return false;
        }else{
            $this->games()->attach($gameId, ['position_id' => $positionId, 'status' => $status]);
            return true;
        }
    }
    
    /**
     * 指定された$gameIdで選手が回答済みかどうか調べる。
     *
     * @param  int  $gameId
     * @return bool
     */
    
    public function is_submitting($gameId)
    {
        return $this->games()->where('game_id', $gameId)->exists();
    }
    
    /**
     * 監督によって選手が指定された$gameIdの試合への参加が確定した。
     *
     * @param  int  $gameId
     * @return bool
     */
    
    public function is_done($gameId)
    {
        return $this->games()->where('game_id', $gameId)->where('status', 2)->exists();
    }
    
    /**
     * 選手が指定された$gameIdの試合への参加を申請中。
     *
     * @param  int  $gameId
     * @return bool
     */
    
    public function is_apply($gameId)
    {
        return $this->games()->where('game_id', $gameId)->where('status', 1)->exists();
    }
    
    /**
     * 選手が指定された$gameIdの試合を欠席。
     *
     * @param  int  $gameId
     * @return bool
     */
    
    public function is_absence($gameId)
    {
        return $this->games()->where('game_id', $gameId)->where('status', 99)->exists();
    }
    
    /**
     * 選手が未回答の試合を取得。
     *
     * @param  int  $gameId
     * @return bool
     */
    
    public function un_answered_games()
    {
        $answered_gameIds = $this->games()->pluck('game_id')->all();
        return Game::whereNotIn('id', $answered_gameIds)->get();
    }
    
    /**
     * 選手が出席する試合（UserGameテーブル）に登録されている選手のposition_idを取得
     * positionテーブルでそのnameを取得。
     *
     * @param  int  $gameId
     * @return bool
     */
    
    public function position_name($gameId)
    {
        $position_id = $this->hasMany(UserGame::class)->where('game_id', $gameId)->get()->first()->position_id;
        return Position::find($position_id)->name;
    }
    
    
}
