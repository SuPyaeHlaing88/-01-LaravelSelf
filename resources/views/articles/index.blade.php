
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Article List</title>
</head>
<body>
    <h1>Article List</h1>
    {{-- <ul> --}}
        {{-- this is Pure PHP  --}}
        {{-- <?php foreach ($articles as $article) : ?>
            <li>
                <?php echo $article['title'] ?>
            </li>
            <?php endforeach ?> --}}

        {{-- this is blade template  --}}
        {{-- @foreach($articles as $article)
        <li>
            {{$article['title']}}
        </li>
        @endforeach
    </ul> --}}

@extends('layouts.app')
@section('content')
    <div class="container">
    {{-- for flash massage --}}
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info')}}
            </div>
        @endif

        {{ $articles->links() }}
        @foreach($articles as $article)
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">{{ $article->created_at->diffForHumans() }}</div>
                <p class="card-text">{{ $article->body }}</p>
                <a href="{{ url("/articles/detail/$article->id") }}" class="card-link">View Detail &raquo;</a>
            </div>
        </div>
        @endforeach
    </div>
@endsection
</body>
</html>