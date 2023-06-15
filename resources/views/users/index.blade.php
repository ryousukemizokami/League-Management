@extends('layouts.app')

@section('content')
    <ul>
        @foreach($users as $user)
        <Li>
            <a href="{{ route('users.show', $user->id) }}">
                <P>{{ $user->name }}</P>
                <P>{{ $user->birthday }}</P>
                <P>{{ $user->position->name }}</P>
            </a>
        </Li>
        @endforeach
    </ul>
@endsection