@extends('layouts.admin')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1>Добавить статью</h1>
        <br>
        <form method="post">
            {!!csrf_field()!!}
            <p>Выбор категории(ий):<br><select name="categories[]" class=form-control multiple>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
            </select></p>
            <p>Название статьи:<br><input type="text" name="title" class="form-control" required></p>
            <p>Автор:<br><input type="text" name="author" class="form-control" required></p>
            <p>Привью:<br><textarea name="short_text" class="form-control"></textarea></p>
            <p>Полный текст:<br><textarea name="full_text" class="form-control"></textarea></p>
            <button type="submit" class="btn btn-success" style="float:right">Создать</button>
        </form>    
    </main>

@stop
