<?php

namespace App\Http\Resources\Genral;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsCommentsResource extends JsonResource
{

    public function toArray($request)
    {
       return [
        'name'             => $this->name ,
        'url'              => $this->url ,
        'comment'          => $this->comment ,
        'status'           => $this->status() ,
        'author_type'      => $this->user_id != '' ? 'Member' : 'Guest',
        'create_date'      => $this->created_at->format('d-m-Y h:i a'),
       ];

    }
}
