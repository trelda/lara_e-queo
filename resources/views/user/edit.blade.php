@extends('home')

@section('user')
    <div class="row">
        <form action="{{ route('user.update', $user->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="access_key" class="form-label">Access Key ID</label>
                <input value="{{ $user->access_key }}" type="text" class="form-control" name="access_key" id="access_key" required>
            </div>
            <label for="secret_key" class="form-label">Secret Key</label>
                <input value="{{ $user->secret_key }}" type="text" class="form-control" name="secret_key" id="secret_key" required>
            </div>
            <div class="mt-5">
                <a href="{{ route('home') }}"  style="text-decoration: none;">
                    <div class="btn btn-info">Назад</div>
                </a>
                <button type="submit" class="btn btn-primary">Обновить</button>
            </div>
        </form>
    <div>
@endsection