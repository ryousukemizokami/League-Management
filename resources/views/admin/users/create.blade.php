@extends('admin.layouts.app')

@section('content')

    <div class="prose mx-auto text-center">
        <h2>選手登録</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('admin.users.store') }}" class="w-1/2">
            @csrf

            <div class="form-control my-4">
                <label for="name" class="label">
                    <span class="label-text">Name</span>
                </label>
                <input type="text" name="name" class="input input-bordered w-full">
            </div>
            
            <div class="form-control my-4">
                <label for="birthday" class="label">
                    <span class="label-text">生年月日</span>
                </label>
                <input type="date" name="birthday" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="email" class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" name="email" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="password" class="label">
                    <span class="label-text">Password</span>
                </label>
                <input type="password" name="password" class="input input-bordered w-full">
            </div>

            {{--<div class="form-control my-4">
                <label for="password_confirmation" class="label">
                    <span class="label-text">Confirmation</span>
                </label>
                <input type="password" name="password_confirmation" class="input input-bordered w-full">
            </div>--}}
            
            <div class="form-control my-4">
                <label for="position_id" class="label">
                    <span class="label-text">Position</span>
                </label>
                <select class="select select-bordered" name="position_id">
                    <option value="0">選択してください</option>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block normal-case">登録</button>
        </form>
    </div>
@endsection