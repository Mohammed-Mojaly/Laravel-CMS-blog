<style>


    body{
        background:#DCDCDC;
        margin-top:20px;
    }
    .card-box {
        padding: 20px !important;
        border-radius: 3px;
        margin-bottom: 30px;
        background-color: #fff !important;
        margin-top: 10px
    }

    .social-links li a {
        border-radius: 50%;
        color: rgba(121, 121, 121, .8);
        display: inline-block;
        height: 30px;
        line-height: 27px;
        border: 2px solid rgba(121, 121, 121, .5);
        text-align: center;
        width: 30px
    }

    .social-links li a:hover {
        color: #797979;
        border: 2px solid #797979
    }
    .thumb-lg {
        height: 90px;
        width: 90px;
    }
    .img-thumbnail {
        padding: .25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: .25rem;
        max-width: 100%;
        height: auto;
    }

    .btn-rounded {

        width: 40%;
        font-weight: 500;
    }
    .text-muted {
        color: #98a6ad!important;
    }
    h4 {
        line-height: 22px;
        font-size: 18px;
    }


    </style>

@extends('layouts.admin')
@section('content')


<div class="card-header py-3 d-flex">
    <h6 class="m-0 font-weight-bold text-primary">Users</h6>
    <div class="ml-auto">
        <a href="{{route('admin.users.create')}}" class="btn btn-primary">
            <span class="icon text-white-50">
                <li class="fa fa-plus"></li>
            </span>
            <span class="text">Add new user</span>
        </a>
    </div>
</div>
    <!-- DataTales Example -->
    <div class="row"  style="background:#f0f1f4">

        @include('backend.users.filter.filter')


        @forelse ($users as $user)

                <div class="col-lg-4">
                    <div class="text-center card-box">
                        <div class="member-card pt-2 pb-2">
                            <div class="thumb-lg member-thumb mx-auto">

                                @if ($user->user_image != '')

                                <img src="{{ asset('assets/users/' . $user->user_image) }}" class="rounded-circle img-thumbnail">
                                @else
                                <img src="{{ asset('assets/users/user.png') }}" class="rounded-circle img-thumbnail">
                            @endif



                            </div>
                            <div class="">
                                <h4>{{ $user->name }}</h4>
                                <p class="text-muted"> <span>@</span><a href="{{ route('admin.users.show' , $user->id)}}" class="text-blue"> {!! $user->username !!}</a></span></p>
                            </div>
                            <ul class="social-links list-inline">
                                <div class="btn-group">
                                    <a href="{{ route('admin.users.edit' , $user->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                    <a href="javascript:void(0);" onclick="if (confirm('Are you sure to delelte this user ?')) {document.getElementById('user-delete-{{$user->id}}').submit();} else{return false;}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>

                                    <form action="{{route('admin.users.destroy',$user->id)}}" id="user-delete-{{$user->id}}"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    </form>
                                </div>


                            </ul>



                            <div class="ml-auto">
                                <a href="{{ route('admin.users.show' , $user->id)}}" class="btn btn-primary btn-rounded">

                                    <span class="text">Details</span>
                                </a>
                            </div>

                            <div class="mt-4">
                                <div class="row">

                                    <div class="col-4">
                                        <div class="mt-3">
                                            <h4>{{$user->posts_count}}</h4>
                                            <p class="mb-0 text-muted">Posts</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-3">
                                            <h4>{{ $user->status() }}</h4>
                                            <p class="mb-0 text-muted">Status</p>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mt-3">
                                            <h4>{{$user->comments_count}}</h4>
                                            <p class="mb-0 text-muted">Comments</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        @empty

                                <span class="text-center">No users found</span>

           @endforelse

           <div class="col-12">
            <div class="float-right">
                {!! $users->appends(request()->input())->links() !!}

            </div>
        </div>

        </div>






@endsection
