@extends('layouts.admin')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit comment on  ({!! $comment->post->title !!})</h6>
            <div class="ml-auto">
                <a href="{{route('admin.post_comments.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <li class="fa fa-home"></li>
                    </span>
                        <span class="text">Comments</span>
                </a>
            </div>
        </div>
        <div class="card-body">


            {!! Form::model($comment,['route' => ['admin.post_comments.update',$comment->id], 'method' => 'patch']) !!}

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        {!!  Form::label('name', 'Name') !!} {{$comment->user_id != '' ? '(Member)' : ''}}
                        {!!  Form::text('name' , old('name' , $comment->name) , ['class' => 'form-control']) !!}
                        @error('name') <span class="text-danger">{{$message}}</span>  @enderror
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        {!!  Form::label('email', 'Email') !!}
                        {!!  Form::email('email' , old('email' , $comment->email) , ['class' => 'form-control summernote']) !!}
                        @error('email') <span class="text-danger">{{$message}}</span>  @enderror
                    </div>
                </div>


                <div class="col-4">
                    <div class="form-group">
                        {!!  Form::label('url', 'Url') !!}
                        {!!  Form::text('url' , old('url' , $comment->url) , ['class' => 'form-control']) !!}
                        @error('url') <span class="text-danger">{{$message}}</span>  @enderror
                    </div>
                </div>


            </div>



            <div class="row">
                <div class="col-6">
                    {!! Form::label('ip_adress', 'ip_adress') !!}
                    {!!  Form::text('ip_adress' , old('ip_adress' , $comment->ip_adress) , ['class' => 'form-control']) !!}
                    @error('ip_adress')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
        <div class="col-6">
            {!! Form::label('status', 'status') !!}
            {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status' , $comment->status), ['class' => 'form-control']) !!}
            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>


    <div class="row">

        <div class="col-12">
            <div class="form-group">
                {!!  Form::label('comment', 'Comment') !!}
                {!!  Form::textarea('comment' , old('url' , $comment->comment) , ['class' => 'form-control' , 'rows' => 5]) !!}
                @error('comment') <span class="text-danger">{{$message}}</span>  @enderror
            </div>
        </div>
    </div>



       <div class="form-group pt-4">
        {!!  Form::submit('Update comment', ['class' => 'btn btn-primary']) !!}
       </div>



            {!! Form::close() !!}

        </div>
    </div>


@endsection
