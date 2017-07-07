@extends('layouts/app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1>{{ $post->title }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <p>
                Publicado por <a href="#">{{ $post->user->name }}</a>
                {{ $post->created_at->diffForHumans() }}
                en <a href="{{ $post->category->url }}">{{ $post->category->name }}</a>.
                @if ($post->pending)
                    <span class="label label-warning">Pendiente</span>
                @else
                    <span class="label label-success">Completado</span>
                @endif
            </p>

            <app-vote score="{{ $post->score }}" vote="{{ $post->current_vote }}"></app-vote>

            {!! $post->safe_html_content !!}

            @if (auth()->check())
                @if (!auth()->user()->isSubscribedTo($post))
                    {!! Form::open(['route' => ['posts.subscribe', $post], 'method' => 'POST']) !!}
                    <button class="btn btn-default" type="submit">Suscribirse al post</button>
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['route' => ['posts.unsubscribe', $post], 'method' => 'DELETE']) !!}
                    <button class="btn btn-default" type="submit">Desuscribirse del post</button>
                    {!! Form::close() !!}
                @endif
            @endif

            <h4>Comentarios</h4>

            <hr>

            {{-- todo: Paginate comments! --}}

            @foreach($post->latestComments() as $comment)
                <article class="{{ $comment->answer ? 'answer' : '' }}">

                    {{ $comment->author->name }}

                    {{-- todo: support markdown in the comments as well! --}}

                    {!! $comment->safe_content !!}

                    @if(Gate::allows('accept', $comment) && !$comment->answer)
                    {!! Form::open(['route' => ['comments.accept', $comment], 'method' => 'POST']) !!}
                        <button type="submit">Aceptar respuesta</button>
                    {!! Form::close() !!}
                    @endif
                </article>
            @endforeach


            {{ $post->latestComments()->render() }}

            {!! Form::open(['route' => ['comments.store', $post], 'method' => 'POST']) !!}

            {!! Field::textarea('comment') !!}

            <button type="submit">
                Publicar comentario
            </button>

            {!! Form::close() !!}
        </div>
        @include('posts.sidebar')
    </div>
@endsection