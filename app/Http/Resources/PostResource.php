<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Transformation layer for Post model
 * @author  JP <jose03@simplexi.com.ph>
 * @version 1.0
 * @since   2021. 06. 04
 */
class PostResource extends JsonResource
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
            'content' => $this->content,
            'author' => new UserResource($this->whenLoaded('author')),
            'date_posted' => $this->created_at->format('Y-m-d H:i:s'),
            'date_posted_for_human' => $this->created_at->diffForHumans(),
        ];
        //return parent::toArray($request);
    }
}
