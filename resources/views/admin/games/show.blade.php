@extends('admin.layouts.app')

@section('content')
    @if(!Auth::check())
        <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
            <div class="hero-content text-center my-10">
                <div class="max-w-md mb-10">
                    <h2>Welcome to League Management</h2>
                    {{-- 監督ログインページへのリンク --}}
                    <a class="btn btn-primary btn-lg normal-case" href="{{ route('admin.login') }}">Login now!</a>
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
                        <th class="text-center"><a href="{{ route('admin.games.show', $game->id) }}">{{ $game->id }}</a></th>
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
                        <a href="{{ route('admin.users.show', $user->id) }}">
                            <li class="list-none">{{ $user->name }} / {{ $user->position_name($game->id) }}</li>
                        </a>
                    @endif
                @endforeach
            </div>
            
            <div class="mt-4">
                <p class="badge badge-primary">参加申請中</p>
                @foreach($game->users as $user)
                    @if($game->is_present($user->id))
                        <a href="{{ route('admin.users.show', $user->id) }}">
                            <li class="list-none">{{ $user->name }} / {{ $user->position_name($game->id) }}</li>
                        </a>
                    @endif
                @endforeach
            </div>
            
            <div class="mt-4">
                <p class="badge badge-primary">不参加</p>
                @foreach($game->users as $user)
                    @if($game->is_absent($user->id))
                        <a href="{{ route('admin.users.show', $user->id) }}">
                            <li class="list-none">{{ $user->name }} / {{ $user->position_name($game->id) }}</li>
                        </a>
                    @endif
                @endforeach
            </div>
            
            <div class="mt-4">
                <p class="badge badge-primary">未回答</p>
                @foreach($un_answered_users as $user)
                    <a href="{{ route('admin.users.show', $user->id) }}">
                        <li class="list-none">{{ $user->name }} / {{ $user->position->name }}</li>
                    </a>
                @endforeach
            </div>
        </div>
        
        <div class="mt-4">
            <h2 class="badge badge-primary">スターティングメンバー</h2>
        </div>
        
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th class="text-center">名前</th>
                    <th class="text-center">ポジション</th>
                    <th class="text-center"></th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="text-center">{{ $user->name }}</td>
                        @if(!$user->is_done($game->id))
                            <form method="post" action="{{ route('admin.games.position.update', $game->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <td class="text-center">
                                    <select class="select select-bordered" name="position_id">
                                        @foreach($positions as $position)
                                            <option value="{{ $position->id }}" {{ $user->position_name($game->id) == $position->name ? 'selected' : '' }}>{{ $position->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><button type="submit" class="text-center btn btn-primary btn-block normal-case">決定</button></td>
                            </form>
                            
                        @else
                            <td class="text-center">{{ $user->position_name($game->id) }}</td>
                            <td class="text-center">決定済</td>
                        @endif
                        
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
@endsection