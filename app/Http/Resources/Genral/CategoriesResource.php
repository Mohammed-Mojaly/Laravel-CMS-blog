<?php

namespace App\Http\Resources\Genral;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name'            => $this->name,
            'slug'            => $this->slug,
            'status'          => $this->status(),
            'url'             => route('frontend.category.posts' , $this->slug),
            'posts_count'     => $this->posts->where('status' , 1)->where('post_type' , 'post')->count(),

        ];
    }
}
