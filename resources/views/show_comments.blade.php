@extends('show_article')
@section('comments')
<!-- Comments section -->
            @if(\Auth::check())
            <form method="post" action="{!!route('comments.add')!!}">
                {!! csrf_field()!!}
                <input type="hidden" value="{{$article->id}}" name="articles_id">
                <p>Комментарии:<br>
                    <textarea class="form-control" name="comment"></textarea>
                </p>
                <br>
                <button type="submit" class="btn btn-success">Добавить комментарий</button>
            </form>
            <br>
            @endif
            
            @foreach($comments as $comment)
            <div class="comment">
                <hr>
                {{$comment->created_at->format('d.m.Y')}} {{_user($comment->user_id)->email}}<br>
                {!!$comment->comment!!}<br>
                
            </div>
            @endforeach
@stop