@extends('layouts.app')

@section('content')
    <div class="prose mx-auto text-center">
        <h2>プロフィール編集</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data" class="w-1/2">
            @csrf
            @method('PUT')
            <div class="form-control my-4">
                <label for="name" class="label">
                    <span class="label-text">Name</span>
                </label>
                <input type="text" value="{{ $user->name }}" name="name" class="input input-bordered w-full">
            </div>
            
            <div class="form-control my-4">
                <label for="birthday" class="label">
                    <span class="label-text">生年月日</span>
                </label>
                <input type="date" value="{{ $user->birthday }}" name="birthday" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="image" class="label">
                    <span class="label-text">アイコン</span>
                </label>
                <input type="file" value="{{ $user->image }}" name="image" class="input w-full">
                <p>設定中のアイコン：{{ $user->image }}</p>
            </div>

            

            <button type="submit" class="btn btn-primary btn-block normal-case">更新</button>
        </form>
    </div>
@endsection