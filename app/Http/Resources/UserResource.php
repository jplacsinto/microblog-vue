<?php

namespace App\Http\Resources;

use App\Http\Resources\PostResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Transformation layer for User model
 * @author  JP <jose03@simplexi.com.ph>
 * @version 1.0
 * @since   2021. 06. 04
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $oRequest
     * @return array
     */
    public function toArray($oRequest)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'avatar' => 'https://picsum.photos/50/50',
            'posts' => PostResource::collection($this->whenLoaded('posts')),
            'url' => url('user/profile/'.$this->id)
        ];
    }
}
