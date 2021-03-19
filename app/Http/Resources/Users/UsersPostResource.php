<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersPostResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'slug'              => $this->slug,
            'description'       => $this->description,
            'status'            => $this->status,
            'status_text'       => $this->status(),
            'comment_able'      => $this->comment_able,
            'category'          => new UsersCategoriesResource($this->category),
            'tags'              => UsersTagsResource::collection($this->tags),
            'media'             => UsersPostsMediaResource::collection($this->media),
            'comments_count'    => $this->comment->count(),
            'comments'          => UsersPostCommentsResource::collection($this->comment),


            // 'id'             => $this->id,
            // 'title'          => $this->title,
            // 'slug'           => $this->slug,
            // 'description'    => $this->description,
            // 'status'         => $this->status(),
            // 'comment_able'   => $this->comment_able,

            // 'category'       => new UsersCategoriesResource($this->category),
            // 'tags'           => UsersTagsResource::collection($this->tags),
            // 'media'          => UsersPostsMediaResource::collection($this->media),
            // 'comments_count' => $this->comment->where('status' , 1)->count(),
            // 'comments'       => UsersPostCommentsResource::collection($this->approved_comment),
        ];
    }
}
