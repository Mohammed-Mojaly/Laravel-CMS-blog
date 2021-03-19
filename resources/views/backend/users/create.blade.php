@extends('layouts.admin')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-3">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create user</h6>
            <div class="ml-auto">
                <a href="{{route('admin.users.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <li class="fa fa-home"></li>
                    </span>
                        <span class="text">Users</span>
                </a>
            </div>
        </div>
        <div class="card-body">


            {!! Form::open(['route' => 'admin.users.store', 'method' => 'post', 'files' => true]) !!}

            <div class="row">

                <div class="col-3">
                    <div class="form-group">
                        {!!  Form::label('name', 'Name') !!}
                        {!!  Form::text('name' , old('name') , ['class' => 'form-control']) !!}
                        @error('name') <span class="text-danger">{{$message}}</span>  @enderror
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        {!!  Form::label('username', 'Username') !!}
                        {!!  Form::text('username' , old('username') , ['class' => 'form-control']) !!}
                        @error('username') <span class="text-danger">{{$message}}</span>  @enderror
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        {!!  Form::label('email', 'Email') !!}
                        {!!  Form::text('email' , old('email') , ['class' => 'form-control']) !!}
                        @error('email') <span class="text-danger">{{$message}}</span>  @enderror
                    </div>
                </div>


               <div class="col-3">
                    <div class="form-group">
                        {!!  Form::label('mobile', 'Mobile') !!}
                        {!!  Form::text('mobile' , old('mobile') , ['class' => 'form-control']) !!}
                        @error('mobile') <span class="text-danger">{{$message}}</span>  @enderror
                    </div>
               </div>
                </div>


                <div class="row">



                <div class="col-3">
                    <div class="form-group">
                        {!!  Form::label('password', 'Password') !!}
                        {!!  Form::password('password'  , ['class' => 'form-control']) !!}
                        @error('password') <span class="text-danger">{{$message}}</span>  @enderror
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        {!!  Form::label('status', 'Status') !!}
                        {!!  Form::select('status' ,['' => '---' , '1' => 'Active' , '0' => 'Inactive'], old('status') , ['class' => 'form-control']) !!}
                        @error('status') <span class="text-danger">{{$message}}</span>  @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        {!!  Form::label('receive_email', 'Receive_email') !!}
                        {!!  Form::select('receive_email' ,['' => '---' , '1' => 'Yes' , '0' => 'No'], old('receive_email') , ['class' => 'form-control']) !!}
                        @error('receive_email') <span class="text-danger">{{$message}}</span>  @enderror
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!!  Form::label('bio', 'Bio') !!}
                        {!!  Form::textarea('description' , old('bio') , ['class' => 'form-control']) !!}
                        @error('bio') <span class="text-danger">{{$message}}</span>  @enderror
                    </div>
                </div>
            </div>




          <div class="row pt-4">
              <div class="col-12">
                {!! Form::label('User Image', 'user_image') !!}
                <br>
          <div class="file-loading">
            {!!  Form::file('user_image', ['id' => 'user-images' ,'class' => 'file-input-overview']) !!}
            @error('user_image')<span class="text-danger">{{ $message }}</span>@enderror
          </div>
        </div>
          </div>


       <div class="form-group pt-4">
        {!!  Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
       </div>



            {!! Form::close() !!}

        </div>
    </div>


@endsection
@section('script')

<script>

    $(function(){

        $('#user-images').fileinput({
            theme: "fas" ,
            maxFileCount: 1,
            allowedFileType:['image'],
            showCancel: true,
            showRemove: false,
            showUpload:false,
            overwriteInitial:false,
        });
    });
</script>

@endsection
