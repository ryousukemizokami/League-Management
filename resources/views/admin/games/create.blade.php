@extends('admin.layouts.app')

@section('content')

    <div class="prose mx-auto text-center">
        <h2>選手登録</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('admin.games.store') }}" class="w-1/2">
            @csrf

            <div class="form-control my-4">
                <label for="day" class="label">
                    <span class="label-text">日にち</span>
                </label>
                <input type="date" name="day" class="input input-bordered w-full">
            </div>
            
            <div class="form-control my-4">
                <label for="time" class="label">
                    <span class="label-text">時間</span>
                </label>
                <input type="time" name="time" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="battleteam" class="label">
                    <span class="label-text">対戦相手</span>
                </label>
                <input type="text" name="battleteam" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="place" class="label">
                    <span class="label-text">場所</span>
                </label>
                <input type="text" name="place" class="input input-bordered w-full">
            </div>
            
            <div class="form-control my-4">
                <label for="memo" class="label">
                    <span class="label-text">メモ</span>
                </label>
                <textarea name="memo" class="input input-bordered w-full"></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block normal-case">登録</button>
        </form>
    </div>
@endsection