<?php

namespace App\Http\Livewire\Backend;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class LastPostcomments extends Component
{
    public function render()
    {
        $posts = Post::wherePostType('post')->withCount('comment')->orderBy('id' , 'desc')->take(5)->get();
        $comments = Comment::orderBy('id' , 'desc')->take(5)->get();

        return view('livewire.backend.last-postcomments' ,[
            'posts'    => $posts,
            'comments'    => $comments,
        ]);
    }
}
