@extends('admin.layouts.app')

@section('content')
    <h2>{{ $user->name }}が参加する試合</h2>
    
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
            @foreach($user->games as $game)
                @if($user->is_done($game->id))
                    <tr>
                        <th class="text-center"><a href="{{ route('admin.games.show', $game->id) }}">{{ $game->id }}</a></th>
                        <td class="text-center">{{ $game->day }}</td>
                        <td class="text-center">{{ $game->time }}</td>
                        <td class="text-center">{{ $game->battleteam }}</td>
                        <td class="text-center">{{ $game->place }}</td>
                        <td class="text-center">{{ $game->memo }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection