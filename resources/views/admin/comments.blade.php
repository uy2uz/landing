@extends('layouts.admin')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1>Комментарии</h1>
        <br>
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Статья</th>
                <th>Пользователь</th>
                <th>Комментарий</th>
                <th>Статус</th>
                <th>Дата добавления</th>
                <th>Действия</th>
            </tr>
            @foreach($comments as $comment)
            <tr>
                <td>{{$comment->id}}</td>
                <td>{{_article($comment->articles_id)->title}}</td>
                <td>{{_user($comment->user_id)->email}}</td>
                <td>{{$comment->comment}}</td>
                <td>@if($comment->status) Опубликован
                    @else На модерации<br><a href="{{route('comment.accepted', ['id' => $comment->id])}}">Одобрить</a>
                    @endif
                </td>
                <td>{{$comment->created_at->format('d-m-Y H:i')}}</td>
                <td><a href="javascript:;" class="delete" rel="{{$comment->id}}">Удалить</a></td>
            </tr>    
            @endforeach
        </table>  
    </main>
@stop
@section('js')
<script>
    $(function(){
        $('.delete').on('click',function(){
            if(confirm("Вы действительно хотите удалить комментарий?")){
                let id = $(this).attr("rel");
                $.ajax({
                    type: "DELETE",
                    url: "{!!route('comments.delete')!!}",
                    data: {_token:"{{csrf_token()}}", id:id},
                    complete: function(){
                        alert("Комментарий удален.");
                        location.reload();
                    }
                    
                });
            }else{
                alertify.error("Действие отменено пользователем");
            }
        });
    });
</script>
@stop
