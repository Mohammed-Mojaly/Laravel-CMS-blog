<?php

namespace App\Http\Resources\Genral;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsMediaResource extends JsonResource
{

    public function toArray($request)
    {
        return [

            'file_name'    => $this->file_name,
            'file_type'    => $this->file_type,
            'file_size'    => $this->file_size,
            'file_size'    => asset('assets/posts/'.$this->file_name),
        ];
    }
}
