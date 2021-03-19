<?php

namespace App\Http\Resources\Genral;


use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Genral\CategoriesResource;
use App\Http\Resources\Genral\UsersResource;

class PostsResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            // 'title'          => $this->title,
            // 'slug'           => $this->slug,
            // 'url'            => route('frontend.posts.show' , $this->slug),
            // 'description'    => $this->description,
            // 'status'         => $this->status(),
            // 'comment_able'   => $this->comment_able,
            // 'create_date'    => $this->created_at->format('d-m-Y h:i a'),
            // 'auther'         => new UsersResource($this->User),
            // 'category'       => new CategoriesResource($this->category),
            // 'tags'           => TagsResource::collection($this->tags),
            // 'media'          => PostsMediaResource::collection($this->media),
            // 'comments_count' => $this->comment->where('status' , 1)->count(),



            'title'             => $this->title,
            'slug'              => $this->slug,
            'url'               => route('frontend.posts.show', $this->slug),
            'description'       => $this->description,
            'status'            => $this->status(),
            'comment_able'      => $this->comment_able,
            'create_date'       => $this->created_at->format('d-m-Y h:i a'),
            'author'            => new UsersResource($this->user),
            'category'          => new CategoriesResource($this->category),
            'tags'              => TagsResource::collection($this->tags),
            'media'             => PostsMediaResource::collection($this->media),
            'comments_count'    => $this->comment->where('status', 1)->count(),

        ];
    }
}
