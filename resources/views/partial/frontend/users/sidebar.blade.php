<div class="wn__sidebar">


    <aside class="widget recent_widget">

             <ul>

                <li class="list-group-item">
                    <img src="{{asset('assets/users/default.jpeg')}}" alt="{{auth()->user()->name}}">
                </li>


                    <li class="list-group-item"><a href="{{route('users.dashboard')}}">My Posts</a></li>
                    <li class="list-group-item"> <a href="{{route('users.post.create')}}">Create Post</a></li>
                      <li class="list-group-item"><a href="{{route('users.comments')}}">Manage Comments</a></li>
                     <li class="list-group-item"> <a href="{{route('users.update_info')}}">Update Profile</a></li>
                      <li class="list-group-item"><a href="{{route('frontend.logout')}}"   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>


            </ul>

    </aside>
</div>
