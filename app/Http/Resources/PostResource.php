<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    // public static $wrap = 'post';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'category' => $this->resource->category,
            'excerpt' => $this->resource->excerpt,
            'body' => $this->resource->body,
            'user' => new UserResource($this->resource->user),
        ];
    }
}
