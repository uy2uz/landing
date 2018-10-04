@extends('layouts.app')
@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('/blog/img/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>Clean Blog</h1>
              <span class="subheading">A Blog Theme by Start Bootstrap</span>
            </div>
          </div>
        </div>
      </div>
    </header>
    <hr>
    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @foreach ($articles as $article)
          <div class="post-preview">
            <a href="{{route('blog.show', [
                'id' => $article->id,
                'slug' => str_slug($article->title)
            ])}}">
              <h2 class="post-title">
                {{$article->title}}
              </h2>
              <h3 class="post-subtitle">
                {!!$article->short_text!!}
              </h3>
            </a>
            <p class="post-meta">Автор: 
              <a href="#">{{$article->author}}</a>
              опубликовано: {{$article->created_at->format('d-m-Y H:i')}}</p>
          </div>
          <hr>
          @endforeach
@stop