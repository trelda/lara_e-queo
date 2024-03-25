@extends('home')
    @section('file')
    <div class="row">
        <form method="post" action="{{ route('file.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Выберите pdf файл</label>
                <input type="file" name="file" accept=".pdf">
            </div>
            <button type="submit">Send</button>
        </form>
    </div>
    @endsection