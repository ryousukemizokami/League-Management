@if (Auth::check())
    {{-- チーム詳細ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('teams.index') }}">チームprofile</a></li>
    {{-- メンバー詳細ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('users.index') }}">member</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover" href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>
@else
    {{-- ユーザ登録ページへのリンク --}}
    {{-- <li><a class="link link-hover" href="{{ route('register') }}">Signup</a></li> --}}
    <li class="divider lg:hidden"></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">Login</a></li>
@endif