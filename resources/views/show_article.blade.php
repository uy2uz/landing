@extends('layouts.app')
@section('content')

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('/blog/img/post-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
              <h1>{{$article->title}}</h1>
              <h2 class="subheading">{{$article->short_text}}</h2>
              <span class="meta">Автор: 
                  <a href="">{{$article->author}}</a>
                опубликовано: {{$article->created_at->format('d-m-Y H:i')}}</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            {!!$article->full_text!!}
          </div>
            <br>
            <br>
        </div>
      @yield('comments')    
      </div>
    </article>
    <hr>
    @stop