@extends('admin.layouts.app')

@section('content')
    <ul class="grid grid-cols-12 gap-4">
        @foreach($users as $user)
            <li class="col-span-3">
                <a href="{{ route('admin.users.show', $user->id) }}">
                    <div class="card card-bordered">
                        @if($user->image != NULL)
                            <figure>
                                <img src="{{ asset('uploads') }}/{{ $user->image }}" style="width: 100px; height: 100px;" alt="{{ $user->image }}">
                            </figure>
                        @else
                            <figure>
                                <img src="{{ asset('images/NO-IMAGE.png') }}" style="width: 100px; height: 100px;" alt="{{ $user->image }}">
                            </figure>
                        @endif
                        
                        <div class="card-body">
                            <ul>
                                <li class="text-center">{{ $user->name }}</li>
                                <li class="text-center">{{ $user->birthday }}</li>
                                <li class="text-center">{{ $user->position->name }}</li>
                            </ul>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
@endsection