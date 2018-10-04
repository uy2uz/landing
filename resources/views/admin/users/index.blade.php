@extends('layouts.admin')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1>Список пользователей</h1>
        <br>
        <br>
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>e-mail</th>
                <th>Роль</th>
                <th>Дата регистрации</th>
                <th>Действия</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->email}}</td>
                <td>@if($user->isAdmin) Администратор @else Пользователь @endif</td>
                <td>{{$user->created_at}}</td>
                <td><a href="javascript:;" class="delete" rel="{{$user->id}}">Удалить</a></td>
            </tr>    
            @endforeach
        </table>  
    </main>
@stop
@section('js')
<script>
    $(function(){
        $('.delete').on('click',function(){
            if(confirm("Вы действительно хотите удалить пользователя?")){
                let id = $(this).attr("rel");
                $.ajax({
                    type: "DELETE",
                    url: "{{route('users.delete')}}",
                    data: {_token:"{{csrf_token()}}", id:id},
                    complete: function(){
                        alert("Пользователь удален");
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
