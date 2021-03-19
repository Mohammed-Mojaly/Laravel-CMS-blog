<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersPostsResource extends JsonResource
{


    public function toArray($request)
    {

        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'slug'           => $this->slug,
            'status_text'    => $this->status(),
            'comment_able'   => $this->comment_able,
            'create_date'    => $this->created_at->format('d-m-Y h:i a'),
            'comments_count' => $this->comment->where('status' , 1)->count(),
        ];
    }

}
