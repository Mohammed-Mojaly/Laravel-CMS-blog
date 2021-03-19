<div class="wn__sidebar">
    <!-- Start Single Widget -->


	    <div class="card my-4">

          <h3 class="card-header">Search</h3>
          <div class="card-body">


			    {!! Form::open(['route' => 'frontend.search' , 'method' => 'Get']) !!}
            <div class="form-input">


                {{-- @error('Keyword') <span class="text-danger">{{$message}}</span>@enderror --}}
					<div class="input-group">
				 {!! Form::text('Keyword' , old('Keyword' , request()->Keyword),['class' => 'form-control' , 'placeholder' => 'Search']) !!}
				<span class="input-group-append">
                {!! Form::button('<i class="fa fa-search"></i>' ,[ 'class'=>'btn btn-secondary' , 'type' => 'submit']) !!}
              </span>
               </div>


            {!! Form::close() !!}
			 </div>

          </div>

        </div>



  <div class="card my-4">
    <aside class="widget recent_widget">
        <h3 class="card-header">Recent Posts</h3>
		   <div class="card-body">
        <div class="recent-posts">
            <ul>

                @foreach ($recent_posts as $recent_post)


                <li>
                    <div class="post-wrapper d-flex">


                        <div class="thumb">

                        <a href="{{ route('frontend.posts.show', $recent_post->slug) }}">

                            @if ($recent_post->media->count()>0)
                            <img  src="{{asset('assets/posts/' . $recent_post->media->first()->file_name)}}"  alt="{{$recent_post->title}}" width="100" height="50" class="rounded">
                            @else
                            <img  src="{{asset('assets/posts/default_small.jpg')}}"  alt="{{$recent_post->title}}" width="100" height="50" class="rounded">
                            @endif

                        </a>


                        </div>
                        <div class="content">
                            <h4>  <a href="{{ route('frontend.posts.show', $recent_post->slug) }}">{{ \Illuminate\Support\Str::limit($recent_post->title, 15 , '...')}} </a></h4>
                            <p>	{{$recent_post->created_at->format('M d, Y')}}</p>
                        </div>
                    </div>
                </li>


                @endforeach

            </ul>
        </div>
		</div>
    </aside>
	</div>




 <div class="card my-4">
    <aside class="widget comment_widget">
        <h3 class="card-header">Recent Comments</h3>
		 <div class="card-body">
        <ul>
            @foreach ($recent_comments as $recent_comment)

            <li>
                <div class="post-wrapper">
                    <div class="thumb">
                        <img src="{{get_gravatar($recent_comment->email,47)}}" alt="{{$recent_comment->name}}">

                    </div>
                    <div class="content">
                        <p>{{$recent_comment->name}} says:</p>
                        <a href="#">{{Illuminate\Support\Str::limit( $recent_comment->comment , 25 ,'...')}}</a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
		 </div>
    </aside>

   </div>






 <div class="card my-4">
    <aside class="widget category_widget">
        <h3 class="card-header">Categories</h3>
		 <div class="card-body">
        <ul>
            @foreach ($categories as $categorie)
            <li><a href="{{route('frontend.category.posts' , $categorie->slug)}}">{{$categorie->name}}</a></li>
            @endforeach

        </ul>
		</div>
    </aside>
	</div>


 <div class="card my-4">
    <aside class="widget category_widget">
        <h3 class="card-header">Tags</h3>
		 <div class="card-body">
        <ul>
            @foreach ($tags as $tag)
          <span style="background: #ebebeb none repeat scroll 0 0; color:#333; display: inline-block; font-size: 12px; line-height: 20px; margin: 5px 5px 0 0; padding: 5px 15px; text-transform: capitalize;">  <a href="{{route('frontend.tag.posts' , $tag->slug)}}">{{$tag->name}}</a></span>
            @endforeach


        </ul>
		</div>
    </aside>
	</div>


 <div class="card my-4">
    <aside class="widget archives_widget">
        <h3 class="card-header">Archives</h3>
		<div class="card-body">
        <ul>
            @foreach ($archives as $key => $val)
            <li><a href="{{ route('frontend.archive.posts', $key .'-' . $val) }}">{{date("F", mktime(0,0,0, $key ,1 )) . ' ' . $val}}</a></li>
            @endforeach
        </ul>
		</div>
    </aside>
    <!-- End Single Widget -->
</div>
