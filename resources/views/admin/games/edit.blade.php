@extends('admin.layouts.app')

@section('content')
    <div class="prose mx-auto text-center">
        <h2>試合情報更新</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('admin.games.update', $game->id) }}" class="w-1/2">
            @csrf
            @method('PUT')
            <div class="form-control my-4">
                <label for="day" class="label">
                    <span class="label-text">日にち</span>
                </label>
                <input type="date" value="{{ $game->day }}" name="day" class="input input-bordered w-full">
            </div>
            
            <div class="form-control my-4">
                <label for="time" class="label">
                    <span class="label-text">時間</span>
                </label>
                <input type="time" value="{{ $game->time }}" name="time" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="battleteam" class="label">
                    <span class="label-text">対戦相手</span>
                </label>
                <input type="text" value="{{ $game->battleteam }}" name="battleteam" class="input input-bordered w-full">
            </div>
            
            <div class="form-control my-4">
                <label for="place" class="label">
                    <span class="label-text">場所</span>
                </label>
                <input type="text" value="{{ $game->place }}" name="place" class="input input-bordered w-full">
            </div>
            
            <div class="form-control my-4">
                <label for="memo" class="label">
                    <span class="label-text">メモ</span>
                </label>
                <textarea value="{{ $game->memo }}" name="memo" class="input input-bordered w-full"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block normal-case">更新</button>
        </form>
    </div>
@endsection