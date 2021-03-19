@extends('layouts.app')
@section('content')

<div class="page-blog-details section-padding--lg bg--white">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="blog-details content" style="margin-top: 24px">
                    <article class="blog-post-details" style="background: #ffffff; padding: 13px; border-radius: 10px;">

                          {{-- image for post --}}
                        @if($post->media->count() >0 )

                        <div class="post_header">
                            <h2>{{$post->title}}</h2>
                            <ul class="post_author">
                                <li>Posts by : <a href="{{route('frontend.author.posts' ,$post->user->username)}}">{{$post->user->name}}</a></li>
                                <hr   style="  height: 1px;">
                          <li>  Posted on  {{$post->created_at->format('M d, Y')}}</li>
                            </ul>
                        </div>
                        <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($post->media as $media)
                                <li data-target="#carouselIndicators" data-slide-to="{{$loop->index}}" class="{{$loop->index ==0  ? 'active' : ''}}"></li>
                                @endforeach

                            </ol>
                            <div class="carousel-inner">
                                @foreach ($post->media as $media)

                                <div class="carousel-item {{$loop->index ==0  ? 'active' : ''}}">
                                    <img class="d-block w-100" src="{{asset('assets/posts/' . $media->file_name)}}" alt="{{$post->title}}">
                                  </div>

                                @endforeach
                            </div>

                            @if($post->media->count() >1)
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                            @endif
                          </div>

                        @endif
                        {{-- image for post --}}
                        <hr   style="  height: 1px;">

                        <div class="post_wrapper">

                            <div class="post_content">
                                <p>{!! $post->description !!}</p>

                                @if ($post->tags->count() > 0)
                                <div class="post__meta">
                                    <span>Tags : </span>
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('frontend.tag.posts', $tag->slug) }}" class="bg-info p-1"><span class="text-white">{{ $tag->name }}</span></a>
                                    @endforeach
                                </div>
                            @endif

                            </div>
                            <ul class="blog_meta">
                                <li>{{ $post->approved_comment->count() }} comment(s)</li>
                                <li> / </li>
                                <li>Category:<a href="{{route('frontend.category.posts' , $post->category->slug)}}">{{$post->category->name}}</a></li>
                            </ul>
                            <ul class="social__net--4 d-flex justify-content-start">
                                <li><a href="#"><i class="zmdi zmdi-rss"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-linkedin"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-vimeo"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-tumblr"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </article>



                    <div class="comment_respond" style="margin-bottom: 50px;">


                        {!! Form::open([ 'route' => ['frontend.posts.add_comment' , $post->slug] , 'method' => 'post' , 'class' => 'comment__form']) !!}


                            <div class="input__box">
                                <h4 class="card-header">Add Comment</h4>
                                {!! Form::textarea('comment' , old('comment'),['placeholder' => 'Your comment here']) !!}
                                @error('comment') <span class="text-danger"> {{$message}} </span> @enderror
                            </div>
                            <div class="input__wrapper clearfix">
                                <div class="input__box name one--third">
                                    <label>Name</label>
                                    {!! Form::text('name' , old('name'),['placeholder' => 'Your name here']) !!}
                                    @error('name') <span class="text-danger"> {{$message}} </span> @enderror
                                </div>
                                <div class="input__box email one--third">
                                    <label>email</label>
                                    {!! Form::email('email' , old('email'),['placeholder' => 'Your email here']) !!}
                                    @error('email') <span class="text-danger"> {{$message}} </span> @enderror
                                </div>
                                <div class="input__box website one--third">
                                    <label>Website</label>
                                    {!! Form::text('url' , old('url'),['placeholder' => 'Your url here']) !!}
                                    @error('url') <span class="text-danger"> {{$message}} </span> @enderror
                                </div>
                            </div>
                            <div class="submite__btn">
                                {!! Form::submit('Post Comment' , ['class' => 'btn btn-primary']) !!}

                            </div>
                    {!! Form::close() !!}
                    </div>
                    <div class="comments_area">
                        <h3 class="card-header">{{ $post->approved_comment->count() }} comment(s)</h3>
                        <ul class="comment__list" style=" background: white;border-radius: 6px;">

                            {{-- for print comment --}}
                            @forelse ($post->approved_comment as $comment)
                            <li>
                                <div class="wn__comment">
                                    <div class="thumb">
                                        <img src="{{get_gravatar($comment->email,46)}}" alt="comment images">
                                    </div>
                                    <div class="content">
                                        <div class="comnt__author d-block d-sm-flex">
                                            <span><a href="{{$comment->url != '' ? $comment->url : ''}}">{{$comment->name}}</a></span>
                                            <span> {{$comment->created_at->format('H d Y h:i a')}}</span>

                                        </div>
                                        <p>{{$comment->comment}}</p>
                                    </div>
                                </div>
                            </li>

                            @empty

                            <li>
                                <div class="wn__comment">

                                        <p>no comment found</p>
                            </li>


                            @endforelse


                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                @include('partial.frontend.sidebar')
            </div>
        </div>
    </div>
</div>

@endsection
