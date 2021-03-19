@extends('layouts.admin')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create page</h6>
            <div class="ml-auto">
                <a href="{{route('admin.pages.index')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <li class="fa fa-home"></li>
                    </span>
                        <span class="text">Pages</span>
                </a>
            </div>
        </div>
        <div class="card-body">


            {!! Form::open(['route' => 'admin.pages.store', 'method' => 'post', 'files' => true]) !!}

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!!  Form::label('title', 'Title') !!}
                        {!!  Form::text('title' , old('title') , ['class' => 'form-control']) !!}
                        @error('title') <span class="text-danger">{{$message}}</span>  @enderror
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!!  Form::label('description', 'Description') !!}
                        {!!  Form::textarea('description' , old('description') , ['class' => 'form-control summernote']) !!}
                        @error('description') <span class="text-danger">{{$message}}</span>  @enderror
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-6">
                    {!! Form::label('category_id', 'category_id') !!}
                    {!! Form::select('category_id', ['' => '---'] + $categorie[0], old('category_id'), ['class' => 'form-control']) !!}
                    @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

        <div class="col-6">
            {!! Form::label('status', 'status') !!}
            {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status'), ['class' => 'form-control']) !!}
            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

          <div class="row pt-4">
              <div class="col-12">
                {!! Form::label('Sliders', 'images') !!}
                <br>
          <div class="file-loading">
            {!!  Form::file('images[]', ['id' => 'page-images' ,'class' => 'file-input-overview', 'multiple' => 'multiple']) !!}
            @error('images')<span class="text-danger">{{ $message }}</span>@enderror
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
        $('.summernote').summernote({
            height: 250,
            toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
        });

        $('#page-images').fileinput({
            theme: "fas" ,
            maxFileCount: 5,
            allowedFileType:['image'],
            showCancel: true,
            showRemove: false,
            showUpload:false,
            overwriteInitial:false,
        });
    });
</script>

@endsection
