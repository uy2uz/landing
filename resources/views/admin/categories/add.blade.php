@extends('layouts.admin')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1>Добавить категорию</h1>
        <br>
        <form method="post">
            {!!csrf_field()!!}
            <p>Введите название категории:<br><input type="text" name="title" class="form-control" required></p>
            <p>Описание категории:<br><textarea name="description" class="form-control"></textarea></p>
            <button type="submit" class="btn btn-success" style="float:right">Создать</button>
        </form>    
    </main>

@stop
