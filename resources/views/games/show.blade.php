@extends('layouts.app')

@section('content')
    @if(!Auth::check())
        <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
            <div class="hero-content text-center my-10">
                <div class="max-w-md mb-10">
                    <h2>Welcome to League Management</h2>
                    {{-- 選手ログインページへのリンク --}}
                    <a class="btn btn-primary btn-lg normal-case" href="{{ route('login') }}">Login now!</a>
                </div>
            </div>
        </div>
    @else
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th class="text-center">試合ID</th>
                    <th class="text-center">日にち</th>
                    <th class="text-center">時間</th>
                    <th class="text-center">対戦相手</th>
                    <th class="text-center">場所</th>
                    <th class="text-center">メモ</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <th class="text-center"><a href="{{ route('games.show', $game->id) }}">{{ $game->id }}</a></th>
                        <td class="text-center">{{ $game->day }}</td>
                        <td class="text-center">{{ $game->time }}</td>
                        <td class="text-center">{{ $game->battleteam }}</td>
                        <td class="text-center">{{ $game->place }}</td>
                        <td class="text-center">{{ $game->memo }}</td>
                    </tr>
            </tbody>
        </table>
        
        <h2>参加状況</h2>
        <div class="flex justify-between">
            <div class="mt-4">
                <p class="badge badge-primary">参加確定</p>
                @foreach($game->users as $user)
                    @if($game->is_determined($user->id))
                        <a href="{{ route('users.show', $user->id) }}">
                            <li class="list-none">{{ $user->name }} / {{ $user->position_name($game->id) }}</li>
                        </a>
                    @endif
                @endforeach
            </div>
            
            <div class="mt-4">
                <p class="badge badge-primary">参加申請中</p>
                @foreach($game->users as $user)
                    @if($game->is_present($user->id))
                        <a href="{{ route('users.show', $user->id) }}">
                            <li class="list-none">{{ $user->name }} / {{ $user->position_name($game->id) }}</li>
                        </a>
                    @endif
                @endforeach
            </div>
            
            <div class="mt-4">
                <p class="badge badge-primary">不参加</p>
                @foreach($game->users as $user)
                    @if($game->is_absent($user->id))
                        <a href="{{ route('users.show', $user->id) }}">
                            <li class="list-none">{{ $user->name }} / {{ $user->position_name($game->id) }}</li>
                        </a>
                    @endif
                @endforeach
            </div>
            
            <div class="mt-4">
                <p class="badge badge-primary">未回答</p>
                @foreach($un_answered_users as $user)
                    <a href="{{ route('users.show', $user->id) }}">
                        <li class="list-none">{{ $user->name }} / {{ $user->position->name }}</li>
                    </a>
                @endforeach
            </div>
        </div>
        

        
        @if(!Auth::user()->is_submitting($game->id))
            <form method="POST" action="{{ route('games.submit', $game->id ) }}">
                @csrf
                <div class="flex gap-2 mb-4">
                    <div class="form-control items-center">
                    <label for="present" class="label cursor-pointer">
                        <input type="radio" value="1" name="status" id="present" class="radio" checked>
                        <span class="label-text">参加</span>
                    </label>
                    </div>
                    <div class="form-control items-center">
                        <label for="present" class="label cursor-pointer">
                            <input type="radio" value="99" name="status" id="absent" class="radio">
                            <span class="label-text">不参加</span>
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary normal-case">登録</button>
            </form>
        @else
        
        <p class="mt-4">出欠回答済</p>
        
        {{-- 回答削除フォーム --}}
        <form method="POST" action="{{ route('games.destroy', $game->id) }}" class="my-2">
            @csrf
            @method('DELETE')
            
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <button type="submit" class="btn btn-error btn-outline" onclick="return confirm('id = {{ $game->id }} の試合の回答を修正します。よろしいですか？')">回答修正</button>
        </form>
        
        @endif
        
    @endif
    
@endsection