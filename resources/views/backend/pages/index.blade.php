@extends('layouts.admin')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Pages</h6>
            <div class="ml-auto">
                <a href="{{route('admin.pages.create')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <li class="fa fa-plus"></li>
                    </span>
                    <span class="text">Add new page</span>
                </a>
            </div>
        </div>

        @include('backend.pages.filter.filter')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>User date</th>
                            <th>Created at</th>
                            <th class="text-center" style="width: 30px;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pages as $page)
                        <tr>
                            <td><a href="{{ route('admin.pages.show' , $page->id) }}">{{$page->title}}</a></td>
                            <td>{{ $page->status() }}</td>
                            <td><a href="{{ route('admin.pages.index' , ['category_id' => $page->category_id]) }}"> {{$page->category->name}}</a></td>
                            <td>{{$page->user->name}}</td>
                            <td>{{$page->created_at->format('d-m-Y h:i a') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.pages.edit' , $page->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0);" onclick="if (confirm('Are you sure to delelte this page ?')) {document.getElementById('page-delete-{{$page->id}}').submit();} else{return false;}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>

                                    <form action="{{route('admin.pages.destroy',$page->id)}}" id="page-delete-{{$page->id}}"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Pages found</td>
                            </tr>
                        @endforelse



                    </tbody>

                    <tfoot>
                        <tr>

                            <th colspan="6">
                                <div class="float-right">
                                {!! $pages->appends(request()->input())->links() !!}

                            </div>
                        </th>
                        </tr>
                    </tfoot>


                </table>

        </div>
    </div>



@endsection
