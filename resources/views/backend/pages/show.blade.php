@extends('layouts.admin')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{$page->title}}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.pages.create')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <li class="fa fa-home"></li>
                    </span>
                        <span class="text">Pages</span>
                </a>
            </div>
        </div>

            <div class="table-responsive">
                <table class="table table-hover">


                    <tbody>

                        <tr>
                            <td colspan="4"><a href="{{ route('admin.pages.show' , $page->id) }}">{{$page->title}}</a></td>
                        </tr>

                        <tr>
                            <th>Category</th>
                            <td>{{$page->category->name}}</td>
                            <th>Status</th>
                            <td>{{ $page->status() }}</td>
                        </tr>

                        <tr>

                            <th>Auther</th>
                            <td>{{$page->user->name}}</td>
                            <th>Created date</th>
                            <td>{{$page->created_at->format('d-m-Y h:i a') }}</td>

                        </tr>

                        <tr>
                            <td colspan="7">
                                <div class="row">
                                @if($page->media->count() >0)
                                @foreach($page->media as $media)
                                <div class="col-4">
                                  <img src="{{asset('assets/posts/' . $media->file_name)}}" class="img-fluid">
                                </div>
                                @endforeach
                            @endif
                        </div>
                            </td>

                        </tr>

                    </tbody>

                </table>

        </div>
    </div>



@endsection
