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
                    <th class="text-center">参加者</th>
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
                        <td class="text-center">
                            @foreach($game->users as $user)
                                @if($game->is_determined($user->id))
                                    <li class="list-none">{{ $user->name }} / {{ $user->position_name($game->id) }}</li>
                                @endif
                            @endforeach
                        </td>
                    </tr>
            </tbody>
        </table>
        
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
        @endif
        
    @endif
    
@endsection