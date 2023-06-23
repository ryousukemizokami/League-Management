@extends('layouts.app')

@section('content')
    <h2>チーム名</h2>
    <ul>
        <li>設立：<span>2021/10/19</span></li>
        <li>監督：<span>kantoku</span></li>
        <li>選手数：<span>{{ $count_user }}人</span></li>
    </ul>
@endsection