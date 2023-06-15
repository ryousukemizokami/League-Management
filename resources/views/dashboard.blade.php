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
        
        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">プロフィール編集</a>
        
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
                @foreach($games as $game)
                    <tr>
                        <th class="text-center"><a href="route('games.show')">{{ $game->id }}</a></th>
                        <td class="text-center">{{ $game->day }}</td>
                        <td class="text-center">{{ $game->time }}</td>
                        <td class="text-center">{{ $game->battleteam }}</td>
                        <td class="text-center">{{ $game->place }}</td>
                        <td class="text-center">{{ $game->memo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    @endif
    
@endsection