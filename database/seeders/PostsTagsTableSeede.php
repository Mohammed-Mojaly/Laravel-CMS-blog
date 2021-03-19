<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostsTagsTableSeede extends Seeder
{

    public function run()
    {

        $posts = Post::all();
        foreach ($posts as $post) {
            $tags = Tag::inRandomOrder()->take(3)->pluck('id')->toArray();
            $post->tags()->sync($tags);
        }

    }
}
