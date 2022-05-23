<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'Title' => $this->title,
            'Body' => $this->body,
            'Image' =>$this->image,
            // 'Category' => new CategoryResource($this->category),
            // 'Tags' => new TagsResource($this->tags),
            // 'User' => new UserResource($this->user)
        ];
    }
}
