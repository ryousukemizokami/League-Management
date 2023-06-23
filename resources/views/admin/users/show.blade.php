@extends('admin.layouts.app')

@section('content')



    {{-- メッセージ削除フォーム --}}
    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="my-2">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-error btn-outline" 
            onclick="return confirm('id = {{ $user->id }} の選手を削除します。よろしいですか？')">選手削除</button>
    </form>

    <h2 class="badge badge-primary">{{ $user->name }}/参加確定</h2>
    
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
    
    <h2 class="badge badge-primary">{{ $user->name }}/参加申請中</h2>
    
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
                @if($user->is_apply($game->id))
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
    
    <h2 class="badge badge-primary">{{ $user->name }}/不参加</h2>
    
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
                @if($user->is_absence($game->id))
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
    
    <h2 class="badge badge-primary">{{ $user->name }}/未回答</h2>
    
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
            @foreach($un_answered_games as $game)
                    <tr>
                        <th class="text-center"><a href="{{ route('admin.games.show', $game->id) }}">{{ $game->id }}</a></th>
                        <td class="text-center">{{ $game->day }}</td>
                        <td class="text-center">{{ $game->time }}</td>
                        <td class="text-center">{{ $game->battleteam }}</td>
                        <td class="text-center">{{ $game->place }}</td>
                        <td class="text-center">{{ $game->memo }}</td>
                    </tr>
            @endforeach
        </tbody>
    </table>
@endsection