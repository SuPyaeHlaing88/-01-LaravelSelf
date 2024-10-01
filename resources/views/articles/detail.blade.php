{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail</title>
</head>
<body> --}}
    @extends ("layouts.app")
    @section("content")
    <div class="container">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }}
                    {{-- show the category type of using model relationship --}}
                    Category: <b>{{ $article->category->name }}</b>
                </div>
                <p class="card-text">{{ $article->body }}</p>
                <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-danger">Delete</a>
            </div>
        </div>

        {{-- show the comments of using model relationship --}}
        <ul class="list-group">
            <li class="list-group-item active">
                <b>Comments ({{ count($article->comments ) }})</b>
            </li>
            @foreach ($article->comments as $comment)
            <li class="list-group-item">
                {{ $comment->content }}    
            </li> 
            <a href="{{ url("/comments/delete/$comment->id") }}" class="row-1 col-1 btn btn-danger">Delete</a>
            @endforeach
        </ul>
        {{-- for actions to comments --}}
        <form action="{{ url('/comments/add') }}" method="post">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <div class="row-1 mt-2">
            <textarea name="content" class="col-10 form-control mb-1" placeholder="New Comment"></textarea>
            <input type="submit" value="Add comment" class="col-2 btn btn-secondary">
            </div>
        </form>
    </div>
    @endsection
{{-- </body>
</html> --}}