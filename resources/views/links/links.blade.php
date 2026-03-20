@extends('base')

@section('title', 'Сокращение ссылок')

@section('content')
    <div class="card p-4 shadow-sm">
        <h2 class="mb-3">Сокращение ссылок</h2>

        <form method="POST" action="/shorten">
            @csrf

            <input type="text" name="url" class="form-control" placeholder="Вставьте ссылку">

            <button class="btn btn-success mt-2">Сократить</button>
        </form>

        @isset($shortLink)
            <div class="alert alert-success mt-4">
                <p><strong>Короткая ссылка:</strong></p>
                <a href="{{ $shortLink }}" target="_blank">{{ $shortLink }}</a>
            </div>
        @endisset
    </div>
@endsection
