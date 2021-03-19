@extends('layouts.app')
@section('content')

  <!-- Start Blog Area -->
  <div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="blog-page" style="    padding: 24px;">

                    @forelse ($posts as $post)
                    <article class="blog__post d-flex flex-wrap" style="background: white; border-radius: 15px">
                        <div class="thumb">
                            <a href="{{ route('frontend.posts.show', $post->slug) }}">

                                @if ($post->media->count()>0)
                                <img  src="{{asset('assets/posts/' . $post->media->first()->file_name)}}"  alt="{{$post->title}}" style="padding: 20px;" width="250" height="300" >
                                @else
                                <img  src="{{asset('assets/posts/default.jpg')}}"  alt="{{$post->title}}" style="padding: 20px;" width="250" height="300">
                                @endif

                            </a>
                        </div>
                        <div class="content" style=" padding: 24px;">
                            <h4><a href="{{ route('frontend.posts.show', $post->slug) }}">{{$post->title}}</a></h4>
                            <ul class="post__meta">
                                <li>Posts by : <a href="{{route('frontend.author.posts' , $post->user->username)}}">{{$post->user->name}}</a></li>
                                <li class="post_separator">/</li>
                                <li>{{$post->created_at->format('M d Y')}}</li>
                            </ul>
                            {{-- <p>{!!  \Illuminate\Support\Str::limit($post->description, 120 , '...') !!}</p> --}}
                            <p>{!!  \Illuminate\Support\Str::limit($post->description, 120 , '...') !!}</p>
                            <div class="blog__btn">
                                <a class="shopbtn" href="{{ route('frontend.posts.show', $post->slug) }}">read more</a>
                            </div>
                            @if($post->tags->count() > 0)

                            <ul class="post__meta">
                                <li>Tags : </li>
                                @foreach ($post->tags as $tag)
                                <li><a href="{{route('frontend.tag.posts' , $tag->slug)}}"> <span class="label label-info">{{$tag->name}}</span> </a></li>
                                @endforeach
                            </ul>

                            @endif

                        </div>
                    </article>
                    <!-- End Single Post -->
                    @empty
                    <div class="text-center">No Posts</div>

                    @endforelse



                </div>
                {{-- <ul class="wn__pagination">
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
                </ul> --}}
                {!! $posts->appends(request()->input())->links() !!}
            </div>
            <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                @include('partial.frontend.sidebar')
            </div>
        </div>
    </div>
</div>
<!-- End Blog Area -->

@endsection
