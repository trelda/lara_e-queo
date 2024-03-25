@extends('home')

@section('files')
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">name</th>
                    <th scope="col">user_id</th>
                    <th scope="col">status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($files as $file)
                <tr>
                    <td>
                        <div class="col">
                            {{ $file->name }}
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            {{ $file->user_id }}
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            {{ $file->status }}
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
        {{ $files->withQueryString()->links() }}
        </div>

    <div>
@endsection