@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                @guest
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('Требуется авторизация') }}
                @else
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.edit', Auth::user()->id) }}">Профиль</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('file.upload') }}">Загрузка</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('file.index') }}">Файлы</a>
                            </li>
                        </ul>
                    </nav>
                    @yield('user')
                    @yield('file')
                    @yield('files')
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection
